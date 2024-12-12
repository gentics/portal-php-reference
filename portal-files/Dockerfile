FROM php:8.2-fpm-bullseye as runtime

# Install Debian packages
RUN apt-get update -y \
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
		apache2 \
		supervisor \
	&& rm -rf /var/lib/apt/lists/*

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

COPY --from=composer:lts /usr/bin/composer /usr/bin/composer

FROM runtime as build

ARG REPO_USERNAME
ARG REPO_PASSWORD

WORKDIR /portal
COPY portal/ /portal

RUN [ ! -z "$REPO_USERNAME" ] \
 && composer --no-ansi --working-dir=/portal config --auth http-basic.repo.gentics.com -- $REPO_USERNAME $REPO_PASSWORD \
 && composer --no-ansi --working-dir=/portal install

FROM runtime
RUN docker-php-ext-enable \
	opcache

# Install xdebug, but don't enable it by default
RUN echo yes | pecl install xdebug

# Add opcache configuration
ADD portal-files/php-opcache.ini /usr/local/etc/php/conf.d/opcache.ini

RUN a2dismod mpm_prefork mpm_worker
RUN a2enmod mpm_event rewrite headers proxy proxy_http proxy_fcgi setenvif http2
RUN update-rc.d apache2 disable

# Update certificates 
RUN update-ca-certificates

ENV PATH="/root/.composer/vendor/bin:${PATH}"

WORKDIR /portal

# Files that are copied from docker/ have to be reincluded in .dockeringore
COPY --from=build /portal /portal
COPY portal-files/*.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/*.sh

# Apache
RUN rm /etc/apache2/sites-enabled/000-default.conf
COPY portal-files/apache2/vhost.conf /etc/apache2/sites-enabled/000-default.conf
COPY portal-files/apache2/keycloak-proxy.conf /etc/apache2/sites-enabled/001-keycloak.conf
COPY portal-files/apache2/portal.conf /etc/apache2/
COPY portal-files/apache2/ports.conf /etc/apache2/
COPY portal-files/apache2/portal.conf.d/*.conf /etc/apache2/portal.conf.d/

# Create stdout pipe for Laravel log file
RUN rm -f /portal/storage/logs/laravel.log && \
	mkdir -p /portal/storage/logs && \
	ln -s /dev/stderr /portal/storage/logs/laravel.log

RUN rm -f /usr/local/etc/php-fpm.d/www.conf
COPY portal-files/portal-fpm.conf /usr/local/etc/php-fpm.d/www.conf
COPY portal-files/supervisord-portal-php.conf /etc/supervisor/conf.d/portal-php.conf

ENTRYPOINT ["entrypoint.sh"]

EXPOSE 8080
CMD ["supervisord"]