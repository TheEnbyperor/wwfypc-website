import graphene
from graphene_django.types import DjangoObjectType
from graphql_relay import from_global_id
from . import models


class ServicePageSectionType(DjangoObjectType):
    class Meta:
        model = models.ServicePageSection
        interfaces = (graphene.relay.Node, )

    def resolve_image(self, info):
        return self.image.url


class ServicePageType(DjangoObjectType):
    sections = graphene.List(ServicePageSectionType)

    class Meta:
        model = models.ServicePage
        interfaces = (graphene.relay.Node, )

    def resolve_sections(self, info):
        return self.sections.all()

    def resolve_header_background(self, info):
        return self.header_background.url


class Query:
    service_pages = graphene.List(ServicePageType)
    service_page = graphene.Field(ServicePageType, id=graphene.NonNull(graphene.ID))

    def resolve_service_page(self, info, id):
        return models.ServicePage.objects.get(id=from_global_id(id)[1])

    def resolve_service_pages(self, info):
        return models.ServicePage.objects.all()
