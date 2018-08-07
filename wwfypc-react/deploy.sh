#!/bin/bash

HASH=`git log --pretty=format:'%H' -n 1`

docker build -t evilben/wwfypc-react:$HASH .
docker push evilben/wwfypc-react:$HASH
cat kubes/deploy.yaml | sed "s/(hash)/$HASH/g" | kubectl apply -f -
kubectl -n lmi rollout status deployment/wwfypc-react
