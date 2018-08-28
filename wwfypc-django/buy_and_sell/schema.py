import graphene
from graphene_django.types import DjangoObjectType
from . import models


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
