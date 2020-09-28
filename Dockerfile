FROM php:7.3.8-fpm-alpine
RUN apk add --no-cache openssl bash mysql-client icu icu-dev icu-libs libpng libpng-dev zip libzip libzip-dev freetype-dev libjpeg-turbo-dev libpng-dev \
  libltdl \
  libmcrypt-dev \
  php7-fileinfo \
  php7-mbstring 
RUN docker-php-ext-configure zip --with-libzip
RUN docker-php-ext-install pdo pdo_mysql intl gd zip
RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ 

ENV DOCKERIZE_VERSION v0.6.1
RUN wget https://github.com/jwilder/dockerize/releases/download/$DOCKERIZE_VERSION/dockerize-alpine-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
    && tar -C /usr/local/bin -xzvf dockerize-alpine-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
    && rm dockerize-alpine-linux-amd64-$DOCKERIZE_VERSION.tar.gz


#COPY .docker ./.docker

WORKDIR /var/www
RUN rm -rf /var/www/html
#RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN curl -sS https://getcomposer.org/installer | php  -- --version=1.9.0 --install-dir=/usr/local/bin --filename=composer

EXPOSE 9000
ENTRYPOINT ["php-fpm"]

