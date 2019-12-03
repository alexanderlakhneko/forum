FROM nginx:1.15-alpine

ENV DOCKERIZE_VERSION v0.6.1
RUN wget https://github.com/jwilder/dockerize/releases/download/$DOCKERIZE_VERSION/dockerize-alpine-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
    && tar -C /usr/local/bin -xzvf dockerize-alpine-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
    && rm dockerize-alpine-linux-amd64-$DOCKERIZE_VERSION.tar.gz

COPY /nginx/nginx.conf /etc/nginx/nginx.conf
COPY /nginx/default.conf /etc/nginx/conf.d/default.conf
RUN echo "daemon off;" >> /etc/nginx/nginx.conf
COPY laraApp/public /usr/share/nginx/html
COPY /nginx/docker/dockerize.sh /usr/share/nginx/

RUN rm -rf /usr/share/nginx/html/index.html



