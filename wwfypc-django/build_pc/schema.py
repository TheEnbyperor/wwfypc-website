import graphene
import json
from django.core.exceptions import ObjectDoesNotExist
from graphene import ObjectType
from graphene_django import DjangoObjectType
from graphql_relay import from_global_id
from graphql import GraphQLError
from . import models
import main_site.schema


def pc_id_to_data(id):
    data = json.loads(id)
    try:
        base_pc = models.BasePcModel.objects.get(id=data.get("base"))
        options = list(map(lambda o: models.CustomisationOption.objects.get(id=o), data.get("options", [])))
    except (models.Base.DoesNotExist, models.CustomisationOption.DoesNotExist):
        raise Exception("item-nonexistent")
    return base_pc, options


def get_item(id):
    print(id)
    base_pc, options = pc_id_to_data(id)
    base_price = base_pc.base_price
    for o in options:
        base_price += o.additional_cost
    return main_site.schema.CartItem(
        name=base_pc.name,
        price=base_price,
        quantity_available=-1,
        image=base_pc.image.url,
        specs=map(lambda s: main_site.schema.CartItemSpec(name=s.customisation.name, value=s.name), options),
        deliveries=map(lambda s: main_site.schema.CartItemDelivery(name=s.name, price=s.price, id=f"BuildPc:{s.id}"),
                       base_pc.postage.all()),
    )


def validate_item(id, delivery, quantity):
    try:
        base_pc, options = pc_id_to_data(id)
    except ObjectDoesNotExist:
        return [("id", ["Invalid pc"])]
    seen_customisations = []
    for o in options:
        if o.customisation.id in seen_customisations:
            return [("id", ["Invalid options"])]
    delivery = delivery.split(":")
    if delivery[0] != "BuildPc":
        return [("delivery", ["Invalid delivery"])]
    try:
        delivery = models.PcPostage.objects.get(id=delivery[1])
    except models.PcPostage.DoesNotExist:
        return [("delivery", ["Invalid delivery"])]
    if delivery.pc.id != base_pc.id:
        return [("delivery", ["Invalid delivery"])]


def calculate_price(id, delivery, quantity):
    base_pc, options = pc_id_to_data(id)
    base_price = base_pc.base_price
    for o in options:
        base_price += o.additional_cost
    delivery = delivery.split(":")
    delivery = models.PcPostage.objects.get(id=delivery[1])
    return base_price * quantity + delivery.value * quantity


def make_item_description(id, delivery, quantity):
    base_pc, options = pc_id_to_data(id)
    name = base_pc.name
    for o in options:
        name += f"; {o.name}"

    delivery = delivery.split(":")
    delivery = models.PcPostage.objects.get(id=delivery[1])

    return f"{name}: {delivery.name} x {quantity}"


class CustomisationOptionType(DjangoObjectType):
    class Meta:
        model = models.CustomisationOption
        interfaces = (graphene.relay.Node, )


class CustomisationType(DjangoObjectType):
    options = graphene.NonNull(graphene.List(graphene.NonNull(CustomisationOptionType)))

    class Meta:
        model = models.Customisation
        interfaces = (graphene.relay.Node, )

    def resolve_options(self, info):
        return self.options.all()


class BasePcModelType(DjangoObjectType):
    customisations = graphene.NonNull(graphene.List(graphene.NonNull(CustomisationType)))

    class Meta:
        model = models.BasePcModel
        interfaces = (graphene.relay.Node, )

    def resolve_image(self, info):
        return self.image.url

    def resolve_customisations(self, info):
        return self.customisations.all()


class PcPriceType(ObjectType):
    price = graphene.NonNull(graphene.Float)

    class Meta:
        interfaces = (graphene.relay.Node, )


def get_pc_price(base_pc_id, options):
    options = list(options)
    base_pc = models.BasePcModel.objects.get(id=base_pc_id)
    options_objects = map(lambda o: models.CustomisationOption.objects.get(id=o), options)
    seen_customisations = []
    base_price = base_pc.base_price
    for o in options_objects:
        if o.customisation.id in seen_customisations:
            raise GraphQLError("Invalid options")
        seen_customisations.append(o.customisation.id)
        base_price += o.additional_cost
    data = json.dumps({
        "base": base_pc_id,
        "options": options,
    })
    return PcPriceType(price=base_price, id=data)


class Query:
    base_pc_models = graphene.NonNull(graphene.List(graphene.NonNull(BasePcModelType)))
    base_pc_model = graphene.Field(BasePcModelType, id=graphene.NonNull(graphene.ID))
    pc_price = graphene.Field(
        PcPriceType,
        base_pc=graphene.NonNull(graphene.ID),
        options=graphene.NonNull(graphene.List(graphene.NonNull(graphene.ID)))
    )

    def resolve_base_pc_models(self, info):
        return models.BasePcModel.objects.all()

    def resolve_base_pc_model(self, info, id):
        return models.BasePcModel.objects.get(id=from_global_id(id)[1])

    def resolve_pc_price(self, info, base_pc, options):
        return get_pc_price(from_global_id(base_pc)[1], map(lambda o: from_global_id(o)[1], options))
