# [Ubuntu 14.04 LTS + Nginx ](https://hub.docker.com/r/vignatjevs/nginx/)

-----

To pull this image from Docker Hub:

	docker pull vignatjevs/nginx

To run an instance of this image:

	docker run --name streamflix -d -P -v /path/to/your/site:/var/www/html -v /path/to/your/videos:/videos --link link-to-stremflix-php-fpm -p 8082:80 vignatjevs/nginx

in terms of running streamflix project:

docker run --name streamflix  -d -P -p 8082:80 -v $'(pwd)'/streamflix-docker/streamflix:/var/www/html -v $'(pwd)'/streamflix-docker/nginx-videoserver/mp4:/var/www/html/videos/mp4 -v $'(pwd)'/streamflix-docker/nginx-videoserver/mp4pics:/var/www/html/videos/videopics --link streamflix-mysql-server:mysqldb --link mongodb_streamflix:mongodb --link videoserv:videoserver --link streamflix-php-fpm:streamflix-php-fpm -v $'(pwd)'/streamflix-docker/composer:/composer vignatjevs/nginx
