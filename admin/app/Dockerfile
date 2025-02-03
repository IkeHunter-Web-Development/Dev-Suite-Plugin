FROM node:20-bookworm
LABEL maintainer="web@ikehunter.dev"

WORKDIR /var/www/html/wp-content/plugins/cobolt-suite/admin/app

COPY package.json ./package.json
COPY package-lock.json ./package-lock.json
COPY webpack.config.js ./webpack.config.js

RUN npm install

COPY ./src ./src
COPY ./templates/ ./templates

RUN npm run build

VOLUME /var/www/html/wp-content/plugins/cobolt-suite/admin/app