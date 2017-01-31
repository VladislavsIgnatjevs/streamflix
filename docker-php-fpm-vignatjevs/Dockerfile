FROM bitnami/php-fpm
MAINTAINER Vladislavs Ignatjevs <v.ignatjevs@dundee.ac.uk>



RUN apt-get update && apt-get -y install \
    software-properties-common \
    python-software-properties \
    debian-archive-keyring \
    wget \
    curl \
    vim \
    aptitude \
    dialog \
    net-tools \
    mcrypt \
    build-essential \
    tcl8.5 \
    unzip \
    git

RUN echo 'deb http://packages.dotdeb.org jessie all\n' >> /etc/apt/sources.list
RUN echo 'deb-src http://packages.dotdeb.org jessie all\n' >> /etc/apt/sources.list

RUN wget https://www.dotdeb.org/dotdeb.gpg
RUN apt-key add dotdeb.gpg

RUN apt-get update && apt-get -y install \
    libssl-dev \
    pkg-config \
    autoconf \
    php7.0-mysql \
    php7.0-curl \
    php7.0-gd \
    php7.0-intl \
    php7.0-imap \
    php7.0-mcrypt \
    php7.0-pspell \
    php7.0-recode \
    php7.0-sqlite3 \
    php7.0-tidy \
    php7.0-xmlrpc \
    php7.0-xsl \
    php7.0-mbstring \
    php-gettext



#install ffmpeg removed from jessie (for PHPFFMpeg)

RUN echo 'deb http://www.deb-multimedia.org testing main non-free\n' >> /etc/apt/sources.list

RUN gpg --keyserver pgpkeys.mit.edu --recv-key  5C808C2B65558117
RUN gpg -a --export 5C808C2B65558117 | apt-key add -



RUN apt-get update && apt-get -y install \
    deb-multimedia-keyring

RUN apt-get clean && apt-get update && apt-get install -y yasm nasm \
                    build-essential time automake autoconf \
                    libtool pkg-config libcurl4-openssl-dev

RUN apt-get clean && apt-get update && apt-get install -y intltool \
                    libxml2-dev libgtk2.0-dev \
                    libnotify-dev libglib2.0-dev libevent-dev \
                    checkinstall


RUN mkdir /ffmpeg
COPY ffmpeg_10-1_amd64.deb /ffmpeg
RUN dpkg --install /ffmpeg/ffmpeg_*.deb

COPY mongo_snippet.txt /mongo_snippet.txt

#install composer and dependancies
RUN mkdir /composer-install
RUN wget https://getcomposer.org/installer -P /composer-install

RUN pecl install mongodb
RUN mv /opt/bitnami/php/lib/php/extensions/no-debug-non-zts-20160303/mongodb.so /opt/bitnami/php/lib/php/extensions/mongodb.so
COPY composer.json /composer.json
WORKDIR /
RUN php /composer-install/installer --no-scripts --ignore-platform-reqs && php /composer.phar --no-scripts --ignore-platform-reqs require
#get libraries and php.ini
#RUN composer.phar require mongodb/mongodb

#move composer so it can be accessed as php composer
#RUN mv /var/www/html/composer.phar /usr/local/bin/composer

WORKDIR /var/www/html
