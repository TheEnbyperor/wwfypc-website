#!/bin/bash

HASH=`git log --pretty=format:'%H' -n 1`

docker build -t evilben/wwfypc-django:$HASH wwfypc-django
docker build -t evilben/wwfypc-react:$HASH wwfypc-react
docker build -t evilben/wwfypc-nginx:$HASH config/nginx
docker push evilben/wwfypc-react:$HASH
docker push evilben/wwfypc-django:$HASH
docker push evilben/wwfypc-nginx:$HASH
cat wwfypc-react/kubes/deploy.yaml | sed "s/(hash)/$HASH/g" | kubectl apply -f -
cat kubes/gluster.yaml | kubectl apply -f -
cat kubes/mysql.yaml | kubectl apply -f -
cat kubes/django.yaml | sed "s/(hash)/$HASH/g" | kubectl apply -f -
cat kubes/nginx.yaml | sed "s/(hash)/$HASH/g" | kubectl apply -f -
kubectl -n wwfypc rollout status deploy/wwyfpc-django-test
kubectl -n wwfypc rollout status deploy/wwyfpc-react
kubectl -n wwfypc rollout status deploy/wwyfpc-nginx-test

