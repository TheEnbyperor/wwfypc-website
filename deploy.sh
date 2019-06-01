#!/bin/bash

rsync -rlP --exclude-from=.gitignore wwfypc-django/* root@office.cardifftec.uk:/opt/api
ssh root@office.cardifftec.uk bash <<EOF
cd /opt/api
source venv/bin/activate
pip install -r requirements.txt
python manage.py collectstatic --no-input
python manage.py migrate
systemctl restart api
EOF
