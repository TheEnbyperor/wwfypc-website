import graphene
from graphene_django.types import DjangoObjectType
from graphql_relay import from_global_id
import main_site.schema
from . import models


def get_item(id):
    item = models.Item.objects.get(id=id)
    return main_site.schema.CartItem(
        name=item.name,
        price=item.price,
        quantity_available=1,
        image=item.images.all()[0].image.url,
        specs=map(lambda s: main_site.schema.CartItemSpec(name=s.name, value=s.value), item.specs.all()),
        deliveries=map(lambda d: main_site.schema.CartItemDelivery(name=d.name, price=d.value, id=f"BuyAndSell:{d.id}"),
                       item.postage.all()),
    )


def validate_item(id, delivery, quantity):
    try:
        item = models.Item.objects.get(id=id)
    except models.Item.DoesNotExist:
        return [("id", ["Invalid device"])]
    if item.sold:
        return [("id", ["Invalid device"])]
    delivery = delivery.split(":")
    if delivery[0] != "BuyAndSell":
        return [("delivery", ["Invalid delivery"])]
    try:
        delivery = models.ItemPostage.objects.get(id=delivery[1])
    except models.ItemPostage.DoesNotExist:
        return [("delivery", ["Invalid delivery"])]
    if delivery.item.id != item.id:
        return [("delivery", ["Invalid delivery"])]
    if quantity != 1:
        return [("quantity", ["Invalid quantity"])]


def calculate_price(id, delivery, quantity):
    item = models.Item.objects.get(id=id)
    delivery = models.ItemPostage.objects.get(id=delivery)

    return item.price * quantity + delivery.value * quantity


def make_item_description(id, delivery, quantity):
    item = models.Item.objects.get(id=id)
    delivery = models.ItemPostage.objects.get(id=delivery)

    specs = ", ".join(map(lambda s: f"{s.name}: {s.value}", item.specs.all()))

    return f"{item.name} x {quantity} ({specs}) {delivery.name}"


def place_order(id, delivery, quantity):
    item = models.Item.objects.get(id=id)
    item.sold = True
    item.save()


class ItemCategoryType(DjangoObjectType):
    colour = graphene.Int()

    class Meta:
        model = models.ItemCategory
        interfaces = (graphene.relay.Node, )


class ItemSpecType(DjangoObjectType):
    class Meta:
        model = models.ItemSpec
        interfaces = (graphene.relay.Node, )


class ItemImageType(DjangoObjectType):
    class Meta:
        model = models.ItemImage
        interfaces = (graphene.relay.Node, )

    def resolve_image(self, info):
        return self.image.url


class ItemType(DjangoObjectType):
    class Meta:
        model = models.Item
        interfaces = (graphene.relay.Node, )

    specs = graphene.NonNull(graphene.List(graphene.NonNull(ItemSpecType)))
    images = graphene.NonNull(graphene.List(graphene.NonNull(ItemImageType)))

    def resolve_specs(self, info):
        return self.specs.all()

    def resolve_images(self, info):
        return self.images.all()


class Query:
    buy_and_sell_items = graphene.List(ItemType, category=graphene.ID())

    buy_and_sell_categories = graphene.List(ItemCategoryType)

    def resolve_buy_and_sell_items(self, info, **kwargs):
        category = kwargs.get("category")

        items = models.Item.objects.filter(sold=False)
        if category is not None:
            items = items.filter(category_id=from_global_id(category)[1])

        return items

    def resolve_buy_and_sell_categories(self, info):
        return models.ItemCategory.objects.all()
