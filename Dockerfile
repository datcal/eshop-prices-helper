FROM ubuntu:20.04

LABEL maintainer="burakhamza@mail.ru"
LABEL version="0.1"
LABEL description="docker-laravel-helper"

ARG DEBIAN_FRONTEND=noninteractive

SHELL ["/bin/bash", "-c"]

RUN apt update
RUN apt upgrade -y

RUN apt install -y software-properties-common curl wget

RUN add-apt-repository ppa:ondrej/apache2
RUN add-apt-repository ppa:ondrej/php
RUN curl -fsSL https://deb.nodesource.com/setup_15.x | bash -
RUN wget https://dev.mysql.com/get/mysql-apt-config_0.8.16-1_all.deb
RUN dpkg -i mysql-apt-config_0.8.16-1_all.deb

RUN apt update

RUN apt install -y build-essential vim locate

RUN apt install -y nodejs
RUN npm i -g npm yarn npm-check-updates gulp-cli create-react-app

RUN apt install -y apache2

RUN debconf-set-selections <<< "mysql-community-server mysql-community-server/root-pass password toor"
RUN debconf-set-selections <<< "mysql-community-server mysql-community-server/re-root-pass password toor"
RUN debconf-set-selections <<< "mysql-community-server mysql-server/default-auth-override select Use Legacy Authentication Method (Retain MySQL 5.x Compatibility)"

RUN apt install -y mysql-common mysql-server

RUN apt install -y php7.4 php7.4-apcu php7.4-cli php7.4-common php7.4-curl php7.4-dev php7.4-enchant php7.4-gd php7.4-geoip php7.4-http php7.4-imagick php7.4-json php7.4-mbstring php7.4-mcrypt php7.4-memcached php7.4-mongodb php7.4-mysql php7.4-oauth php7.4-opcache php7.4-pgsql php7.4-ps php7.4-pspell php7.4-psr php7.4-redis php7.4-snmp php7.4-soap php7.4-solr php7.4-sqlite3 php7.4-ssh2 php7.4-tidy php7.4-uploadprogress php7.4-uuid php7.4-xdebug php7.4-xml php7.4-xmlrpc php7.4-xsl php7.4-yaml php7.4-zip

EXPOSE 80 443 3000 4000 5000
