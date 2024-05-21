FROM php:8.3-apache

RUN a2enmod rewrite && a2enmod ssl
RUN mkdir /var/log/apache2/testWikiCamper
RUN mkdir /var/www/certificate
RUN mkdir /var/www/certificate/dwe64
\
RUN echo "ServerName testwikicamper.local" >> /etc/apache2/apache2.conf
RUN apt-get update
RUN apt-get install -y --no-install-recommends locales
RUN apt-get install -y --no-install-recommends apt-utils
RUN apt-get install -y --no-install-recommends git
RUN apt-get install -y --no-install-recommends libicu-dev
RUN apt-get install -y --no-install-recommends g++
RUN apt-get install -y --no-install-recommends libpng-dev
RUN apt-get install -y --no-install-recommends libxml2-dev
RUN apt-get install -y --no-install-recommends libzip-dev
RUN apt-get install -y --no-install-recommends libonig-dev
RUN apt-get install -y --no-install-recommends libxslt-dev
RUN apt-get install -y --no-install-recommends unzip
RUN apt-get install -y --no-install-recommends libpq-dev
RUN echo "en_US.UTF-8 UTF-8" > /etc/locale.gen
RUN echo "fr_FR.UTF-8 UTF-8" >> /etc/locale.gen
RUN locale-gen

RUN curl -sS https://getcomposer.org/installer | php -- \
    &&  mv composer.phar /usr/local/bin/composer
RUN curl -sS https://get.symfony.com/cli/installer | bash \
    &&  mv /root/.symfony5/bin/symfony /usr/local/bin/symfony
RUN apt-get update
RUN apt-get install nodejs -y
RUN node -v
RUN apt-get install npm -y
RUN npm -v
RUN npm install -g yarn
RUN yarn --version
RUN docker-php-ext-configure intl
RUN pecl install apcu xdebug
RUN docker-php-ext-install pdo
RUN docker-php-ext-install pdo_pgsql
RUN docker-php-ext-install opcache
RUN docker-php-ext-install intl
RUN docker-php-ext-install zip
RUN docker-php-ext-install calendar
RUN docker-php-ext-install dom
RUN docker-php-ext-install mbstring
RUN docker-php-ext-install gd
RUN docker-php-ext-install xsl
RUN docker-php-ext-configure intl
RUN docker-php-ext-configure gd
\
RUN docker-php-ext-enable xdebug apcu gd \
    &&  echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    &&  echo "xdebug.log=/tmp/xdebug.log" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    &&  echo "xdebug.client_port=9003" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    &&  echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    &&  echo "xdebug.start-with-request=yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
\
RUN openssl req -x509 -nodes -days 365 \
    -newkey rsa:2048 \
    -keyout /var/www/certificate/dwe64/testWikiCamper.key \
    -out /var/www/certificate/dwe64/testWikiCamper.crt \
    -subj "/C=FR/ST=France/L=Biarritz/O=dwe64/OU=dwe64 Unit/CN=dwe64.io"
RUN apt-get clean && rm -rf /var/lib/apt/lists/*
\
RUN echo "Listen 8502" >> /etc/apache2/ports.conf
RUN echo "Listen 8503" >> /etc/apache2/ports.conf
EXPOSE 8502 8503
WORKDIR /var/www/html/testWikiCamper