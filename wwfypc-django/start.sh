#!/bin/bash

cd /opt/api
source venv/bin/activate
python3 manage.py collectstatic --noinput
python3 manage.py migrate
uwsgi --ini app.ini
