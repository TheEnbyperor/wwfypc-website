FROM node:latest

RUN mkdir /usr/src/app
WORKDIR /usr/src/app

ENV PATH /usr/src/app/node_modules/.bin:$PATH

COPY . /usr/src/app
RUN yarn install
RUN yarn add serve

RUN yarn build

CMD ["bash", "-c", "serve -s build"]
