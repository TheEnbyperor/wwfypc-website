from django.urls import path
from . import views
import selling.views

urlpatterns = [
    # path('post_form/<id>', views.post_form_pdf, name='post_form_pdf'),
    path('estimate/<id>', selling.views.estimate_pdf, name='estimate_pdf'),
]

