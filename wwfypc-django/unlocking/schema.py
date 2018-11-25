import graphene
from graphene_django import DjangoObjectType
from graphql_relay import from_global_id
import main_site.schema
from . import models


def get_item(id):
    id, imei = id.split(";", 1)
    try:
        item = models.UnlockingPrice.objects.get(id=from_global_id(id)[1])
    except models.UnlockingPrice.DoesNotExist:
        raise Exception("item-nonexistent")
    return main_site.schema.CartItem(
        name=f"Unlocking: {item.device.name}",
        price=item.price,
        quantity_available=1,
        image=item.device.image.url,
        specs=[
            main_site.schema.CartItemSpec(name="Network", value=item.network.name),
            main_site.schema.CartItemSpec(name="IMEI", value=imei)
        ],
        deliveries=[main_site.schema.CartItemDelivery(name="Online", price=0, id="Unlocking:1")],
    )


def luhn_checksum(card_number):
    def digits_of(n):
        return [int(d) for d in str(n)]
    digits = digits_of(card_number)
    odd_digits = digits[-1::-2]
    even_digits = digits[-2::-2]
    checksum = 0
    checksum += sum(odd_digits)
    for d in even_digits:
        checksum += sum(digits_of(d*2))
    return checksum % 10


def validate_item(id, delivery, quantity):
    id, imei = id.split(";", 1)
    if len(imei) != 15:
        return [("id", ["Invalid imei"])]
    if luhn_checksum(imei) != 0:
        return [("id", ["Invalid imei"])]
    try:
        models.UnlockingPrice.objects.get(id=from_global_id(id)[1])
    except models.UnlockingPrice.DoesNotExist:
        return [("id", ["Invalid id"])]
    if delivery != "Unlocking:1":
        return [("delivery", ["Invalid delivery"])]
    if quantity != 1:
        return [("quantity", ["Invalid quantity"])]


def calculate_price(id, delivery, quantity):
    id, imei = id.split(";", 1)
    item = models.UnlockingPrice.objects.get(id=from_global_id(id)[1])
    return item.price * quantity


def make_item_description(id, delivery, quantity):
    id, imei = id.split(";", 1)
    item = models.UnlockingPrice.objects.get(id=from_global_id(id)[1])
    return str(item)


class UnlockingDeviceTypeType(DjangoObjectType):
    class Meta:
        model = models.DeviceType
        interfaces = (graphene.relay.Node, )

    def resolve_image(self, info):
        return self.image.url


class UnlockingNetworkType(DjangoObjectType):
    class Meta:
        model = models.Network
        interfaces = (graphene.relay.Node, )


class UnlockingPrice(DjangoObjectType):
    class Meta:
        model = models.UnlockingPrice
        interfaces = (graphene.relay.Node, )


class Query:
    unlocking_device_types = graphene.NonNull(graphene.List(graphene.NonNull(UnlockingDeviceTypeType)))
    unlocking_device_type = graphene.Field(UnlockingDeviceTypeType, id=graphene.NonNull(graphene.ID))
    unlocking_networks = graphene.NonNull(graphene.List(graphene.NonNull(UnlockingNetworkType)))
    unlocking_network = graphene.Field(UnlockingNetworkType, id=graphene.NonNull(graphene.ID))
    unlocking_price = graphene.NonNull(
        UnlockingPrice,
        device=graphene.NonNull(graphene.ID),
        network=graphene.NonNull(graphene.ID),
    )

    def resolve_unlocking_device_types(self, info):
        return models.DeviceType.objects.all()

    def resolve_unlocking_device_type(self, info, id):
        return models.DeviceType.objects.get(id=from_global_id(id)[1])

    def resolve_unlocking_networks(self, info):
        return models.Network.objects.all()

    def resolve_unlocking_network(self, info, id):
        return models.Network.objects.get(id=from_global_id(id)[1])

    def resolve_unlocking_price(self, info, network, device):
        return models.UnlockingPrice.objects.get(network_id=from_global_id(network)[1], device_id=from_global_id(device)[1])
