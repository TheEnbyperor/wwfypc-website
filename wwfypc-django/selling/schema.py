import graphene
from graphql import GraphQLError
from graphene_django.types import DjangoObjectType
from graphql_relay import from_global_id
import django.db.models.query
from . import models


class SellingDevicePermutationValueType(DjangoObjectType):
    class Meta:
        model = models.DevicePermutationValue
        interfaces = (graphene.relay.Node, )


class SellingDevicePermutationType(DjangoObjectType):
    class Meta:
        model = models.DevicePermutation
        interfaces = (graphene.relay.Node, )

    values = graphene.NonNull(graphene.List(graphene.NonNull(SellingDevicePermutationValueType)))

    def resolve_values(self, info):
        return self.values.all()


class SellingValueEstimateType(DjangoObjectType):
    class Meta:
        model = models.ValueEstimate
        interfaces = (graphene.relay.Node, )


class SellingDeviceModelType(DjangoObjectType):
    device_permutations = graphene.NonNull(graphene.List(graphene.NonNull(SellingDevicePermutationType)))

    price_estimate = graphene.Field(
        SellingValueEstimateType,
        permutations=graphene.NonNull(graphene.List(graphene.NonNull(graphene.ID)))
    )

    class Meta:
        model = models.DeviceModel
        interfaces = (graphene.relay.Node, )

    def resolve_device_permutations(self, info):
        return get_device_permutations(self.id)

    def resolve_price_estimate(self, info, permutations):
        return get_device_price(self.id, map(lambda p: from_global_id(p)[1], permutations))


class SellingDeviceCategoryType(DjangoObjectType):
    class Meta:
        model = models.DeviceCategory
        interfaces = (graphene.relay.Node, )

    def resolve_icon(self, info):
        return self.icon.url



def get_device_permutations(device_id):
    estimates = models.ValueEstimate.objects.filter(device_id=device_id)
    permutations = []
    for estimate in estimates:
        for permutation_value in estimate.permutations.all():
            if permutation_value.permutation not in permutations:
                permutations.append(permutation_value.permutation)
    return permutations


class EstimationNode:
    def __init__(self, num, results=None, seen_permutations=None):
        if seen_permutations is None:
            seen_permutations = []
        if results is None:
            results = django.db.models.query.QuerySet()
        self.num = num
        self.results = results
        self.seen_permutations = seen_permutations
        self.next_nodes = []


def _get_device_price(last_node, permutations):
    permutations = list(filter(lambda p: p not in last_node.seen_permutations, permutations))
    if len(permutations) == 0:
        return None
    for permutation in permutations:
        estimates = last_node.results.filter(permutations__id=permutation)
        if estimates.count() == 1 and last_node.num+1 >= estimates[0].permutations.count():
            return estimates[0]
        if estimates.count() != 0:
            node = EstimationNode(last_node.num+1, estimates, last_node.seen_permutations + [permutation])
            estimate = _get_device_price(node, permutations)
            if estimate is not None:
                return estimate


def get_device_price(device_id, permutations):
    estimates = models.ValueEstimate.objects.filter(device_id=device_id)
    root_pass = EstimationNode(0, estimates)
    estimate = _get_device_price(root_pass, permutations)
    if estimate is None:
        raise GraphQLError("Unable to find estimate")
    return estimate


class Query:
    selling_device_categories = graphene.NonNull(graphene.List(graphene.NonNull(SellingDeviceCategoryType)))
    selling_device_category = graphene.Field(
        SellingDeviceCategoryType,
        id=graphene.NonNull(graphene.ID)
    )

    selling_device_models = graphene.NonNull(
        graphene.List(graphene.NonNull(SellingDeviceModelType)),
        category=graphene.ID()
    )
    selling_device_model = graphene.Field(
        SellingDeviceModelType,
        id=graphene.NonNull(graphene.ID)
    )

    def resolve_selling_device_categories(self, info):
        return models.DeviceCategory.objects.all()

    def resolve_selling_device_category(self, info, id):
        return models.DeviceCategory.objects.filter(id=from_global_id(id)[1])

    def resolve_selling_device_models(self, info, **kwargs):
        device_models = models.DeviceModel.objects.all()
        if kwargs.get("category") is not None:
            device_models = device_models.filter(category_id=from_global_id(kwargs["category"])[1])

        return device_models

    def resolve_selling_device_model(self, info, id):
        return models.DeviceModel.objects.get(id=from_global_id(id)[1])

