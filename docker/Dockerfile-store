FROM php:7.1-apache

MAINTAINER "Alejandro Sosa" <alesjohnson@hotmail.com>

RUN  curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN  a2enmod rewrite

COPY store.conf /etc/apache2/sites-available/store.conf
RUN  rm /etc/apache2/sites-enabled/000-default.conf && \
     ln -s /etc/apache2/sites-available/store.conf /etc/apache2/sites-enabled/.

#RUN apt-get install -y nano

EXPOSE 80 5233