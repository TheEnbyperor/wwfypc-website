import pdfkit
import qrcode
import qrcode.image.svg
import string
from io import BytesIO
from django.template.loader import render_to_string
from django.http import HttpResponse
from django.shortcuts import get_object_or_404
from graphql_relay import from_global_id
from . import models


def post_form_pdf(request, id):
    order = get_object_or_404(models.PostalOrder, uid=from_global_id(id)[1])

    fp = BytesIO()
    factory = qrcode.image.svg.SvgPathImage
    img = qrcode.make(order.uid, image_factory=factory, border=1)
    img.save(fp)
    fp.seek(0)
    barcode_data = fp.read().decode()

    config = models.SiteConfig.objects.first()

    if order.additional_items.strip(string.whitespace+string.punctuation) == "":
        order.additional_items = "None"

    html = render_to_string("main_site/post_form_pdf.html", {"barcode": barcode_data, "order": order,
                                                             "config": config}, request)

    if request.GET.get("html") is not None:
        response = HttpResponse(html.encode())
    else:
        response = HttpResponse(pdfkit.from_string(html, False, {
            'page-size': 'A4',
        }), content_type='application/pdf')

    return response
