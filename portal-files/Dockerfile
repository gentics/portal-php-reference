###############################################################################
### Base container
###############################################################################

FROM php:8.3-apache-trixie AS runtime

# Environment Variables
ENV PHP_INI_SCAN_DIR=":/extra-php-conf"

# Install Debian packages
RUN apt-get update -y \
	&& apt-get install -y \
	zip \
	unzip \
	git \
	pkg-config \
	zlib1g-dev \
	jq \
	libgmp-dev \
	libicu-dev \
	libzip-dev \
	g++ \
	&& rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install \
	zip \
	opcache \
	gmp \
	intl \
	exif \
	sysvsem \
	sysvshm

# Enable PHP extensions
RUN docker-php-ext-enable \
	opcache

# Install xdebug, but don't enable it by default
RUN echo yes | pecl install xdebug

# Add required conf files to global conf dir
ADD --chown=portal:www-data portal-files/php-conf/*.ini /usr/local/etc/php/conf.d/

# Install composer
COPY --from=composer:lts /usr/bin/composer /usr/bin/composer

# Setup the portal user and directories
RUN adduser --disabled-password --uid 1000 --ingroup www-data --home /portal portal \
	&& mkdir /extra-php-conf /scripts \
	&& chown portal:www-data /portal /extra-php-conf /scripts \
	&& chmod 775 /portal /extra-php-conf /scripts \
	&& chmod 775 /etc/apache2/sites-enabled/ \
	&& chmod 775 /etc/apache2

# Setup apache
RUN a2enmod rewrite headers proxy proxy_http
RUN rm /etc/apache2/sites-enabled/000-default.conf
COPY --chown=www-data:www-data portal-files/apache2/sites-enabled/*.conf /etc/apache2/sites-enabled/
COPY --chown=www-data:www-data portal-files/apache2/conf/*.conf /etc/apache2/
COPY --chown=www-data:www-data portal-files/apache2/portal.conf.d/*.conf /etc/apache2/portal.conf.d/

###############################################################################
### Install PHP dependencies
###############################################################################

FROM runtime AS build

# Only over the whole portal
COPY --chown=portal:www-data ./portal /portal

USER portal

# Credentials are only mounted for this step and passed via COMPOSER_AUTH,
# so they are neither written to auth.json nor persisted in any image layer.
RUN --mount=type=secret,id=repo-user,uid=1000 \
	--mount=type=secret,id=repo-pass,uid=1000 \
	COMPOSER_AUTH="$(jq -cn \
		--rawfile user /run/secrets/repo-user \
		--rawfile pass /run/secrets/repo-pass \
		'{"http-basic": {"repo.gentics.com": {"username": ($user | rtrimstr("\n")), "password": ($pass | rtrimstr("\n"))}}}')" \
	composer --no-ansi --working-dir=/portal install

###############################################################################
### Portal container
###############################################################################

FROM runtime

# Exposed Ports
EXPOSE 8080

# Update certificates
RUN update-ca-certificates

# Copy the scripts
COPY --chown=portal:www-data portal-files/scripts /scripts

# Copy portal + installed dependencies
COPY --chown=portal:www-data --from=build /portal /portal
# Make sure to delete the .env file
RUN rm -f /portal/.env

# Drop all permissions
USER portal
WORKDIR /portal

# Volumes/Directories which can be mounted
VOLUME /portal
VOLUME /extra-php-conf
VOLUME /scripts

ENTRYPOINT ["/scripts/entrypoint.sh"]
CMD ["apache2-foreground"]
