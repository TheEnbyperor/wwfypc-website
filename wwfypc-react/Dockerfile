FROM node:latest

RUN mkdir /usr/src/app
WORKDIR /usr/src/app

ENV PATH /usr/src/app/node_modules/.bin:$PATH

COPY . /usr/src/app
RUN yarn install
RUN yarn add serve

RUN yarn build

FROM nginx

COPY --from=0 /usr/src/app/build /build
COPY nginx/config.conf /etc/nginx/nginx.conf
