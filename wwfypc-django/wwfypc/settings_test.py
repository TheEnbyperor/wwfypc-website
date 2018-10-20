"""
Django settings for wwfypc project.

Generated by 'django-admin startproject' using Django 2.0.7.

For more information on this file, see
https://docs.djangoproject.com/en/2.0/topics/settings/

For the full list of settings and their values, see
https://docs.djangoproject.com/en/2.0/ref/settings/
"""

import os
import sys

# Build paths inside the project like this: os.path.join(BASE_DIR, ...)
BASE_DIR = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))


# Quick-start development settings - unsuitable for production
# See https://docs.djangoproject.com/en/2.0/howto/deployment/checklist/

# SECURITY WARNING: keep the secret key used in production secret!
SECRET_KEY = os.getenv("DJANGO_SECRET", "")

# SECURITY WARNING: don't run with debug turned on in production!
DEBUG = True

ALLOWED_HOSTS = ["api.test.wwfypc.fluidmedia.wales"]

# Application definition

INSTALLED_APPS = [
    'admin_shortcuts',
    'django.contrib.admin',
    'django.contrib.auth',
    'django.contrib.contenttypes',
    'django.contrib.sessions',
    'django.contrib.messages',
    'django.contrib.staticfiles',
    'graphene_django',
    'corsheaders',
    'solo',
    'ordered_model',
    'adminsortable2',
    'ckeditor',
    'ckeditor_uploader',
    'main_site.apps.MainSiteConfig',
    'buy_and_sell.apps.BuyAndSellConfig',
    'services.apps.ServicesConfig',
    'selling.apps.SellingConfig',
    'unlocking.apps.UnlockingConfig',
    'build_pc.apps.BuildPcConfig',
]

MIDDLEWARE = [
    'corsheaders.middleware.CorsMiddleware',
    'django.middleware.security.SecurityMiddleware',
    'django.contrib.sessions.middleware.SessionMiddleware',
    'django.middleware.common.CommonMiddleware',
    'django.middleware.csrf.CsrfViewMiddleware',
    'django.contrib.auth.middleware.AuthenticationMiddleware',
    'django.contrib.messages.middleware.MessageMiddleware',
    'django.middleware.clickjacking.XFrameOptionsMiddleware',
]

ROOT_URLCONF = 'wwfypc.urls'

TEMPLATES = [
    {
        'BACKEND': 'django.template.backends.django.DjangoTemplates',
        'DIRS': [],
        'APP_DIRS': True,
        'OPTIONS': {
            'context_processors': [
                'django.template.context_processors.debug',
                'django.template.context_processors.request',
                'django.contrib.auth.context_processors.auth',
                'django.contrib.messages.context_processors.messages',
            ],
        },
    },
]

WSGI_APPLICATION = 'wwfypc.wsgi.application'


# Database
# https://docs.djangoproject.com/en/2.0/ref/settings/#databases

DATABASES = {
    'default': {
        'NAME': os.getenv('DB_NAME', 'wwfypc'),
        'USER': os.getenv('DB_USER', 'root'),
        'PASSWORD': os.getenv('DB_PASS', ''),
        'HOST': os.getenv('DB_HOST', 'db'),
        'ENGINE': 'django.db.backends.mysql',
        'PORT': '',
    }
}


# Password validation
# https://docs.djangoproject.com/en/2.0/ref/settings/#auth-password-validators

AUTH_PASSWORD_VALIDATORS = [
    {
        'NAME': 'django.contrib.auth.password_validation.UserAttributeSimilarityValidator',
    },
    {
        'NAME': 'django.contrib.auth.password_validation.MinimumLengthValidator',
    },
    {
        'NAME': 'django.contrib.auth.password_validation.CommonPasswordValidator',
    },
    {
        'NAME': 'django.contrib.auth.password_validation.NumericPasswordValidator',
    },
]


# Internationalization
# https://docs.djangoproject.com/en/2.0/topics/i18n/

LANGUAGE_CODE = 'en-us'

TIME_ZONE = 'UTC'

USE_I18N = True

USE_L10N = True

USE_TZ = True


# Static files (CSS, JavaScript, Images)
# https://docs.djangoproject.com/en/2.0/howto/static-files/

STATIC_ROOT = os.path.join(BASE_DIR, "static")
STATIC_URL = '/static/'

MEDIA_ROOT = os.path.join(BASE_DIR, "media")
MEDIA_URL = '/media/'

GRAPHENE = {
    'SCHEMA': 'wwfypc.schema.schema'
}

CORS_ORIGIN_ALLOW_ALL = True

PHONENUMBER_DEFAULT_REGION = 'GB'

CHROME_PATH = "/usr/bin/google-chrome"

LOGGING = {
    'version': 1,
    'disable_existing_loggers': False,
    'formatters': {
        'verbose': {
            'format': '[django] %(levelname)s %(asctime)s %(module)s %(process)d %(thread)d %(message)s'
        }
    },
    'handlers': {
        'console': {
            'level': 'INFO',
            'class': 'logging.StreamHandler',
            'stream': sys.stdout,
            'formatter': 'verbose'
        },
    },
    'loggers': {
        'django': {
            'handlers': ['console'],
            'level': 'INFO',
            'propagate': True,
        },
    },
}

FILE_UPLOAD_PERMISSIONS = 0o644

EMAIL_BACKEND = 'django.core.mail.backends.smtp.EmailBackend'
EMAIL_HOST = 'front.mailu'

ADMIN_SHORTCUTS = [
    {
        'title': 'General',
        'shortcuts': [
            {
                'title': 'Site config',
                'url_name': 'admin:main_site_siteconfig_change',
            },
            {
                'title': 'Main slider',
                'url_name': 'admin:main_site_mainsliderslide_changelist',
            },
            {
                'title': 'Selling points',
                'url_name': 'admin:main_site_sellingpoint_changelist',
            },
            {
                'title': 'Customers',
                'url_name': 'admin:main_site_customer_changelist',
            },
            {
                'title': 'Services',
                'url_name': 'admin:services_servicepage_changelist',
            },
        ]
    },
    {
        'title': 'Repairs',
        'shortcuts': [
            {
                'title': 'Device Categories',
                'url_name': 'admin:main_site_devicecategory_changelist',
            },
            {
                'title': 'Device Types',
                'url_name': 'admin:main_site_devicetype_changelist',
            },
            {
                'title': 'Repair Types',
                'url_name': 'admin:main_site_repairtype_changelist',
            },
            {
                'title': 'Other Services',
                'url_name': 'admin:main_site_otherservice_changelist',
            },
            {
                'title': 'Postal orders',
                'url_name': 'admin:main_site_postalorder_changelist',
            },
        ],
    },
    {
        'title': 'Appointments',
        'shortcuts': [
            {
                'title': 'Time rules',
                'url_name': 'admin:main_site_appointmenttimerule_changelist',
            },
            {
                'title': 'Block time',
                'url_name': 'admin:main_site_appointmenttimeblockrule_changelist',
            },
            {
                'title': 'Appointments',
                'url_name': 'admin:main_site_appointment_changelist',
            },
        ]
    },
    {
        'title': 'Build a PC',
        'shortcuts': [
            {
                'title': 'Base models',
                'url_name': 'admin:build_pc_basepcmodel_changelist',
            },
            {
                'title': 'Customisation options',
                'url_name': 'admin:build_pc_customisation_changelist',
            },
        ]
    },
    {
        'title': 'Buy & Sell',
        'shortcuts': [
            {
                'title': 'Categories',
                'url_name': 'admin:buy_and_sell_itemcategory_changelist',
            },
            {
                'title': 'Items',
                'url_name': 'admin:buy_and_sell_item_changelist',
            },
        ]
    },
    {
        'title': 'Selling',
        'shortcuts': [
            {
                'title': 'Categories',
                'url_name': 'admin:selling_devicecategory_changelist',
            },
            {
                'title': 'Permutations',
                'url_name': 'admin:selling_devicepermutation_changelist',
            },
            {
                'title': 'Value estimates',
                'url_name': 'admin:selling_valueestimate_changelist',
            },
        ]
    },
    {
        'title': 'Unlocking',
        'shortcuts': [
            {
                'title': 'Devices',
                'url_name': 'admin:unlocking_devicetype_changelist',
            },
            {
                'title': 'Networks',
                'url_name': 'admin:unlocking_network_changelist',
            },
            {
                'title': 'Prices',
                'url_name': 'admin:unlocking_unlockingprice_changelist',
            },
        ]
    },
]

ADMIN_SHORTCUTS_SETTINGS = {
    'show_on_all_pages': False,
    'hide_app_list': False,
    'open_new_window': False,
}

CKEDITOR_UPLOAD_PATH = os.path.join(MEDIA_ROOT, "uploads")
CKEDITOR_IMAGE_BACKEND = "pillow"

CKEDITOR_CONFIGS = {
    'default': {
        'toolbar': 'full',
    },
}
