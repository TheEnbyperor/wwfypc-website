import tempfile
import hardcopy
import qrcode
import qrcode.image.svg
import string
from io import BytesIO
from django.template.loader import render_to_string
from django.http import HttpResponse
from django.shortcuts import get_object_or_404
from . import models


def post_form_pdf(request, id):
    order = get_object_or_404(models.PostalOrder, uid=id)

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
        options = {
            'disable-gpu': None,
            'no-sandbox': None
        }
        with tempfile.NamedTemporaryFile() as file:
            hardcopy.bytestring_to_pdf(html.encode(), file, **options)
            response = HttpResponse(file.read(), content_type='application/pdf')

    return response
