#!/usr/bin/env bash

python3 manage.py collectstatic --no-input
python3 manage.py migrate --settings wwfypc.settings_test
echo Starting Gunicorn.
export DJANGO_SETTINGS_MODULE=wwfypc.settings_test
exec xvfb-run gunicorn wwfypc.wsgi:application \
    --bind 0.0.0.0:8000 \
    --workers 5
