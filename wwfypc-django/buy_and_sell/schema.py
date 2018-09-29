import graphene
from graphene_django.types import DjangoObjectType
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
        deliveries=map(lambda d: main_site.schema.CartItemDelivery(name=d.name, price=d.value, id=d.id), item.postage.all()),
    )


def validate_item(id, delivery, quantity):
    try:
        item = models.Item.objects.get(id=id)
    except models.Item.DoesNotExist:
        return [("id", ["Invalid device"])]
    try:
        delivery = models.ItemPostage.objects.get(id=delivery)
    except models.ItemPostage.DoesNotExist:
        return [("delivery", ["Invalid delivery"])]
    if delivery.item.id != item.id:
        return [("delivery", ["Invalid delivery"])]
    if quantity > 1:
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


class ItemCategoryType(DjangoObjectType):
    colour = graphene.Int()

    class Meta:
        model = models.ItemCategory


class ItemSpecType(DjangoObjectType):
    class Meta:
        model = models.ItemSpec


class ItemImageType(DjangoObjectType):
    class Meta:
        model = models.ItemImage

    def resolve_image(self, info):
        return self.image.url


class ItemType(DjangoObjectType):
    class Meta:
        model = models.Item


class Query:
    buy_and_sell_items = graphene.List(ItemType, category=graphene.ID())

    buy_and_sell_categories = graphene.List(ItemCategoryType)

    def resolve_buy_and_sell_items(self, info, **kwargs):
        category = kwargs.get("category")

        items = models.Item.objects.all()
        if category is not None:
            items = items.filter(category_id=category)

        return items

    def resolve_buy_and_sell_categories(self, info):
        return models.ItemCategory.objects.all()
