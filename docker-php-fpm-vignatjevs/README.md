# What is PHP-FPM?

> PHP-FPM (FastCGI Process Manager) is an alternative PHP FastCGI implementation with some additional features useful for sites of any size, especially busier sites.

[php-fpm.org](http://php-fpm.org/)

This is my version of popular <b>[bitnami/php-fpm image](https://github.com/bitnami/bitnami-docker-php-fpm)</b>

Use dockerfile to build it

It is created for streamflix project that you can find in my repos.

In terms of that project, to start run the following:


    docker run -d --name streamflix-php-fpm  \
    -v $'(pwd)'/streamflix-docker/php-fpm:/bitnami/php-fpm \
    -v $'(pwd)'/streamflix-docker/streamflix:/var/www/html \
    -v $'(pwd)'/streamflix-docker/nginx-videoserver/mp4:/var/www/html/videos/mp4 \
    -v $'(pwd)'/streamflix-docker/nginx-videoserver/mp4pics:/var/www/html/videos/videopics \
    --link streamflix-mysql-server:mysqldb \
    --link mongodb_streamflix:mongodb \
    --link videoserv:videoserver  \
    your_image_id/tag


# License

Copyright (c) 2015-2016 Bitnami

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

    http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
