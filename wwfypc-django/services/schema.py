import graphene
from graphene_django.types import DjangoObjectType
from . import models


class ServicePageSectionType(DjangoObjectType):
    class Meta:
        model = models.ServicePageSection


class ServicePageType(DjangoObjectType):
    sections = graphene.List(ServicePageSectionType)

    class Meta:
        model = models.ServicePage

    def resolve_sections(self, info):
        return self.sections.all()


class Query:
    service_pages = graphene.List(ServicePageType)
    service_page = graphene.Field(ServicePageType, id=graphene.NonNull(graphene.ID))

    def resolve_service_page(self, info, id):
        return models.ServicePage.objects.get(id=id)

    def resolve_service_pages(self, info):
        return models.ServicePage.objects.all()
