from django.urls import path
from . import views

urlpatterns = [
    path('post_form/<id>', views.post_form_pdf, name='post_form_pdf')
]

