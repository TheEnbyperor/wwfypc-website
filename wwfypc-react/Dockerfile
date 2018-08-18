FROM node:latest

RUN mkdir /usr/src/app
WORKDIR /usr/src/app

ENV PATH /usr/src/app/node_modules/.bin:$PATH

COPY . /usr/src/app
RUN yarn install
RUN yarn add serve

ENV BACKEND_HOST http://api.test.wwfypc.fluidmedia.wales
RUN yarn build

FROM funkygibbon/nginx-pagespeed

COPY --from=0 /usr/src/app/build /build
COPY nginx/config.conf /etc/nginx/nginx.conf
