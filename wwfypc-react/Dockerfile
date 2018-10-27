FROM node:latest

RUN mkdir /usr/src/app
WORKDIR /usr/src/app

ENV PATH /usr/src/app/node_modules/.bin:$PATH

COPY package.json /usr/src/app
COPY yarn.lock /usr/src/app
RUN yarn install

COPY . /usr/src/app
RUN yarn build

FROM nginx

COPY --from=0 /usr/src/app/build /build
COPY nginx/config.conf /etc/nginx/nginx.conf
