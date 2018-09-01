import graphene
import main_site.schema
import buy_and_sell.schema
import services.schema


class Query(main_site.schema.Query, buy_and_sell.schema.Query, services.schema.Query, graphene.ObjectType):
    pass


class Mutation(main_site.schema.Mutation, graphene.ObjectType):
    pass


schema = graphene.Schema(query=Query, mutation=Mutation)
