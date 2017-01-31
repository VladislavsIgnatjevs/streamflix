# Pull from the ubuntu:14.04 image
FROM ubuntu:14.04

# Set the author
MAINTAINER Vladislavs Ignatjevs <v.ignatjevs@dundee.ac.uk>

# Update cache and install base packages
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

# Download Nginx signing key
RUN apt-key adv --recv-keys --keyserver keyserver.ubuntu.com C300EE8C

# Add to repository sources list
RUN add-apt-repository ppa:nginx/stable

# Update cache and install Nginx

RUN add-apt-repository -y ppa:mc3man/trusty-media
RUN apt-get update && apt-get -y install \
    nginx \
    ffmpeg\
    nodejs \
    npm


# Turn off daemon mode
# Reference: http://stackoverflow.com/questions/18861300/how-to-run-nginx-within-docker-container-without-halting
RUN echo "\ndaemon off;" >> /etc/nginx/nginx.conf

# Backup the default configurations
#RUN cp /php-fpm/conf/php.ini /php-fpm/conf/php.ini.original.bak
#RUN mv /etc/nginx/sites-available/default /etc/nginx/sites-available/default.original

# Copy default site conf
COPY default.conf /etc/nginx/sites-available/default

# Copy the index.php file
COPY index.php /var/www/html/index.php

# Mount volumes
VOLUME ["/etc/nginx/certs", "/etc/nginx/conf.d", "/var/www/html"]

RUN mv /etc/nginx/nginx.conf /etc/nginx/nginx.conf.default
COPY nginx.conf /etc/nginx/nginx.conf

# Set the current working directory
WORKDIR /var/www/html

# Boot up Nginx
CMD service nginx start

# Expose port 80
EXPOSE 80
EXPOSE 443
