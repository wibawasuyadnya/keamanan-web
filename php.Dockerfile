FROM php:7.4.3-apache

RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN apt-get update && apt-get install -y --no-install-recommends \
    libapache2-mod-security2 \
    && rm -rf /var/lib/apt/lists/*

ADD ./apache_default /etc/apache2/sites-available/000-default.conf

# Copy the modsecurity.conf file
COPY ./modsecurity/modsecurity.conf /etc/modsecurity/modsecurity.conf

# Copy the crs-setup.conf file
COPY ./modsecurity/owasp-modsecurity-crs/crs-setup.conf /etc/modsecurity.d/crs-setup.conf


RUN a2enmod security2
RUN a2enmod unique_id
RUN a2enmod rewrite