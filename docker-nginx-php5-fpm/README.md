# [Ubuntu 14.04 LTS + Nginx + PHP5-FPM + xdebug + ffmpeg + composer + PHP-FFMpeg ](https://hub.docker.com/r/vignatjevs/nginx-php5-fpm-xdebug-ffmpeg/)

This is my attempt on popular NGINX php5-fpm topic.
Made with Nginx, PHP5-FPM, and Ubuntu 14.04. Extras include xdebug, composer, ffmpeg (it was removed from official repos for Ubuntu 14.04, but works in this image), PHP-FFMpeg


-----

To pull this image from Docker Hub:

	docker pull vignatjevs/nginx-php5-fpm-xdebug-ffmpeg

To run an instance of this image:

	docker run --name mycoolserver -d -P -v /path/to/your/site:/var/www/html -v /path/to/your/videos:/videos -p 8082:80 vignatjevs/nginx-php5-fpm-xdebug-ffmpeg
