import graphene
import django.db.models
from graphene import ObjectType
from graphene_django import DjangoObjectType
from graphql_relay import from_global_id
from graphql import GraphQLError
from . import models
import main_site.schema


def get_item(id):
    item = models.PcPrice.objects.get(id=id)
    return main_site.schema.CartItem(
        name=item.base_pc.name,
        price=item.price,
        quantity_available=-1,
        image=item.base_pc.image.url,
        specs=map(lambda s: main_site.schema.CartItemSpec(name=s.customisation.name, value=s.name), item.options.all()),
        deliveries=map(lambda s: main_site.schema.CartItemDelivery(name=s.name, price=s.price, id=f"BuildPc:{s.id}"),
                       item.postage.all()),
    )


def validate_item(id, delivery, quantity):
    try:
        item = models.PcPrice.objects.get(id=id)
    except models.Item.DoesNotExist:
        return [("id", ["Invalid pc"])]
    delivery = delivery.split(":")
    if delivery[0] != "BuildPc":
        return [("delivery", ["Invalid delivery"])]
    try:
        delivery = models.PcPostage.objects.get(id=delivery[1])
    except models.PcPostage.DoesNotExist:
        return [("delivery", ["Invalid delivery"])]
    if delivery.pc.id != id:
        return [("delivery", ["Invalid delivery"])]


def calculate_price(id, delivery, quantity):
    item = models.PcPrice.objects.get(id=id)
    return item.price * quantity


def make_item_description(id, delivery, quantity):
    item = models.PcPrice.objects.get(id=id)

    delivery = delivery.split(":")
    delivery = models.PcPostage.objects.get(id=delivery[1])

    return f"{str(item)}: {delivery.name} x {quantity}"


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


class PriceNode:
    def __init__(self, num, results=None, seen_options=None):
        if seen_options is None:
            seen_options = []
        if results is None:
            results = django.db.models.query.QuerySet()
        self.num = num
        self.results = results
        self.seen_options = seen_options
        self.next_nodes = []


def _get_pc_price(last_node, options):
    options = list(filter(lambda p: p not in last_node.seen_options, options))
    if len(options) == 0:
        return None
    for option in options:
        estimates = last_node.results.filter(options__id=option)
        if estimates.count() == 1 and last_node.num+1 >= estimates[0].options.count():
            return estimates[0]
        if estimates.count() != 0:
            node = PriceNode(last_node.num+1, estimates, last_node.seen_options + [option])
            price = _get_pc_price(node, options)
            if price is not None:
                return price


def get_pc_price(base_pc_id, options):
    prices = models.PcPrice.objects.filter(base_pc_id=base_pc_id)
    root_pass = PriceNode(0, prices)
    price = _get_pc_price(root_pass, options)
    if price is None:
        raise GraphQLError("Unable to find price")
    return price


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
