import io
import qrcode.image.svg
import pdfkit
from django.template.loader import render_to_string
from django.http import HttpResponse
from django.shortcuts import get_object_or_404
from graphql_relay import from_global_id
import main_site.models
from . import models


def estimate_pdf(request, id):
    estimate = get_object_or_404(models.ValueEstimate, id=from_global_id(id)[1])

    fp = io.BytesIO()
    factory = qrcode.image.svg.SvgPathImage
    img = qrcode.make(id, image_factory=factory, border=1)
    img.save(fp)
    fp.seek(0)
    barcode_data = fp.read().decode()

    config = main_site.models.SiteConfig.objects.first()

    html = render_to_string("selling/estimate_pdf.html", {"barcode": barcode_data, "estimate": estimate,
                                                          "config": config}, request)

    if request.GET.get("html") is not None:
        response = HttpResponse(html.encode())
    else:
        response = HttpResponse(pdfkit.from_string(html, False, {
            'page-size': 'A4',
        }), content_type='application/pdf')

    return response
