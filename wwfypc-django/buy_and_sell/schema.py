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
