FROM php:8.1-apache-bullseye

RUN mkdir -p /run/php/

# Install Debian packages
RUN apt-get update -y \
    && apt-get install -y software-properties-common ca-certificates lsb-release apt-transport-https wget gnupg \
    && sh -c 'echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" > /etc/apt/sources.list.d/php.list' \
    && wget -qO - https://packages.sury.org/php/apt.gpg | apt-key add - \
    && apt-get update -y \
    && apt-get install -y \
		zip \
		unzip \
		git \
		pkg-config \
		zlib1g-dev \
		jq \
		libcurl4-openssl-dev \
		libpcre3-dev \
		libgmp-dev \
		libicu-dev \
		libzip-dev \
		g++ \
		php8.1-readline/bullseye \
		php8.1-cli/bullseye \
		php8.1-common/bullseye \
		php8.1-opcache/bullseye \
		php8.1-fpm/bullseye \
	&& rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install PHP extensions
RUN docker-php-ext-install \
	zip \
	opcache \
	gmp \
	intl \
	curl \
	exif \
	sysvsem \
	sysvshm

RUN docker-php-ext-enable \
	opcache

# Install xdebug, but don't enable it by default
RUN echo yes | pecl install xdebug

# Add opcache configuration
ADD portal-files/php-opcache.ini /usr/local/etc/php/conf.d/opcache.ini

RUN a2dismod php mpm_prefork mpm_worker
RUN a2enmod mpm_event rewrite headers proxy proxy_http proxy_fcgi setenvif http2
RUN a2enconf php8.1-fpm
RUN service apache2 restart 

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

RUN rm -f /etc/php/8.1/fpm/pool.d/www.conf
COPY portal-files/portal-fpm.conf /etc/php/8.1/fpm/pool.d/www.conf 
CMD ["service", "php8.1-fpm", "restart"]

ENTRYPOINT ["entrypoint.sh"]

EXPOSE 80
CMD ["apache2-foreground"]
