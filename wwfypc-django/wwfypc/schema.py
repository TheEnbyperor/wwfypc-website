import graphene
import main_site.schema


class Query(main_site.schema.Query, graphene.ObjectType):
    pass


schema = graphene.Schema(query=Query)
