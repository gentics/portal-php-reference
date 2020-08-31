FROM php:7.4-apache-buster

# Install Debian packagess
RUN apt-get update -y \
	&& apt-get install -y \
		zip \
		unzip \
		git \
		pkg-config \
		zlib1g-dev \
		jq \
		libpcre3-dev \
		libgmp-dev \
		libicu-dev \
		libzip-dev \
		g++ \
	&& rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install PHP extensions
RUN docker-php-ext-install \
	zip \
	opcache \
	gmp \
	intl \
	sysvsem \
	sysvshm

RUN docker-php-ext-enable \
	opcache

# Install xdebug, but don't enable it by default
RUN echo yes | pecl install xdebug

# Add opcache configuration
ADD portal-files/php-opcache.ini /usr/local/etc/php/conf.d/opcache.ini

RUN a2enmod rewrite headers proxy proxy_http

# Update certificates 
RUN update-ca-certificates

ENV PATH="/root/.composer/vendor/bin:${PATH}"

WORKDIR /portal

# Files that are copied from docker/ have to be reincluded in .dockeringore
COPY portal/ /portal
COPY portal-files/*.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/*.sh

# Apache
RUN rm /etc/apache2/sites-enabled/000-default.conf
COPY portal-files/apache2/vhost.conf /etc/apache2/sites-enabled/000-default.conf
COPY portal-files/apache2/keycloak-proxy.conf /etc/apache2/sites-enabled/001-keycloak.conf
COPY portal-files/apache2/portal.conf /etc/apache2/
COPY portal-files/apache2/portal.conf.d/*.conf /etc/apache2/portal.conf.d/

# Create stdout pipe for Laravel log file
RUN rm -f /portal/storage/logs/laravel.log && \
	ln -s /dev/stderr /portal/storage/logs/laravel.log

ENTRYPOINT ["entrypoint.sh"]

EXPOSE 80
CMD ["apache2-foreground"]
