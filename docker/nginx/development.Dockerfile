FROM nginx:1.17-alpine
COPY ./bridge.conf /etc/nginx/conf.d/default.conf
COPY ./selfsigned.* /etc/ssl/
EXPOSE 80 443
