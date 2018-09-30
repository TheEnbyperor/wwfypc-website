from django import forms
import phonenumber_field.formfields


class ContactForm(forms.Form):
    name = forms.CharField(max_length=255)
    email = forms.EmailField()
    phone = phonenumber_field.formfields.PhoneNumberField()
    message = forms.CharField()
