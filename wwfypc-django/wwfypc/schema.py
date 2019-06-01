import graphene
import main_site.schema
# import buy_and_sell.schema
# import services.schema
import selling.schema
# import unlocking.schema
# import build_pc.schema


# class Query(main_site.schema.Query, buy_and_sell.schema.Query, services.schema.Query, selling.schema.Query,
#             unlocking.schema.Query, build_pc.schema.Query, graphene.ObjectType):
class Query(main_site.schema.Query,  selling.schema.Query, graphene.ObjectType):
    pass


class Mutation(main_site.schema.Mutation, graphene.ObjectType):
    pass


# schema = graphene.Schema(query=Query, mutation=Mutation)
schema = graphene.Schema(query=Query)
