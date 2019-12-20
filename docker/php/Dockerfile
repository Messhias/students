FROM php:7.4-fpm

# opcache configurations.
ENV PHP_OPCACHE_VALIDATE_TIMESTAMPS="1" \
    PHP_OPCACHE_MAX_ACCELERATED_FILES="32531" \
    PHP_OPCACHE_MEMORY_CONSUMPTION="512" \
    PHP_OPCACHE_MAX_WASTED_PERCENTAGE="10" \
    PHP_OPCACHE_FILE_OVERRIDE=1

# updating the S.O.
RUN apt-get update

# getting the dependencies
RUN apt-get install -y zlib1g-dev \
    libjpeg-dev \
    libpng-dev \
    libfreetype6-dev

# Install Dependencies
RUN ACCEPT_EULA=Y apt-get install -y \
    unixodbc \
    unixodbc-dev \
    libgss3 \
    odbcinst \
    locales \
    && echo "en_US.UTF-8 UTF-8" > /etc/locale.gen && locale-gen

RUN ln -s /usr/lib/x86_64-linux-gnu/libsybdb.a /usr/lib/

# turning on the extensions
RUN docker-php-ext-install gd
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install opcache

# copying custom php.ini configurations into the container.
COPY docker/php/conf.d/opcache.ini /usr/local/etc/php/conf.d/opcache.ini

# creating the working DIR
RUN mkdir -p /code
ENV HOME=/code
WORKDIR $HOME

# setting the default user into the working dir
USER root
COPY ./ $HOME
