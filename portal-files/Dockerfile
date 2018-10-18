FROM php:7.2-apache-stretch

# Install Debian packagess
RUN apt-get update -y \
	&& apt-get install -y \
	openssl \
	zip \
	unzip \
	git \
	libssl-dev \
	libcurl4-openssl-dev \
	pkg-config \
	zlib1g-dev \
	jq

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install PHP extensions
RUN docker-php-ext-install \
	curl \
	pdo \
	mbstring \
	zip

RUN a2enmod rewrite

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
COPY portal-files/vhost.conf /etc/apache2/sites-enabled/000-default.conf

ENTRYPOINT ["entrypoint.sh"]

EXPOSE 80
CMD ["apache2-foreground"]
