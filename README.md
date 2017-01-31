# streamflix
DevOps assignment 2016/2017

StremFlix - dockerized streaming application

consists of:

1. [Nginx for Frontend](https://hub.docker.com/r/vignatjevs/nginx/)
2.  [Custom PHP7.0-FPM] - please use Dockerfile under <b>docker-php-fpm-vignatjevs</b> dir
3. [MongoDB ](https://hub.docker.com/r/tutum/mongodb/)
4. [PHPMyAdmin ](https://hub.docker.com/r/phpmyadmin/phpmyadmin)
5. [MySQL Server](https://hub.docker.com/r/centurylink/mysql)
6. [NGINX+rtmp](https://hub.docker.com/r/vignatjevs/nginx-rtmp/)
7. [Composer](https://hub.docker.com/_/composer/)

There are 2 ways to run <b>Stream</b>Flix.
One way would be to run nginx with php5-fpm under one container, the other way is more favorable. 

You can run PHP7.0-fpm and nginx as separate container!

This is the easiest option, to do this, cd to repo dir and run:

```
./build
```

Otherwise you can pull,build all the images needed yourself and run them as per your needs.
Take extra care when naming containers since they are name dependent. Use <b>docker-commands.txt</b> for guidance.

The project has docker-compose.yml but unfortunately it is <b>not working due to unavailability to pass some parameters needed for composer</b>

-----
-----

<b>Running with PHP5-FPM:</b>
(if you want to run php-fpm and nginx under one container)

Pull everything below. Comment php7 code blocks and uncomment php 5 code blocks.
There are certain files that are completely changed:
eg: main_for_old_mongodriver.php, upload_for_old_mongodriver.php, video_for_old_mongodriver.php
You will need to rename them into main.php, upload.php, video.php respectively.

Take care with instances where Old mongo driver might be used, i tried my best to keep all the code for php 5 but there might be some blocks that I missed

Either pull or build the following:

1. [Ubuntu 14.04 LTS + NGINX + PHP5-FPM + xdebug + ffmpeg + composer + PHP-FFMpeg ](https://hub.docker.com/r/vignatjevs/nginx-php5-fpm-xdebug-ffmpeg/)
2. [MongoDB ](https://hub.docker.com/r/tutum/mongodb/)
3. [PHPMyAdmin ](https://hub.docker.com/r/phpmyadmin/phpmyadmin)
4. [MySQL Server](https://hub.docker.com/r/centurylink/mysql)
5. [NGINX+rtmp](https://hub.docker.com/r/vignatjevs/nginx-rtmp/)

if you want to build, you can

```
  docker build . --tag="your preferred name"
```
But if you decide to build container yourself take extra care when copypasting running commands, since containers are name dependent on each other.
-----

You can start with pulling images from Docker Hub:
```
docker pull vignatjevs/nginx-php5-fpm-xdebug-ffmpeg
docker pull vignatjevs/nginx-rtmp
docker pull phpmyadmin/phpmyadmin
docker pull tutum/mongodb
docker pull centurylink/mysql
```
-----

Or build your own version of my images:
you can find a docker file in this repo or [here](https://github.com/VladislavsIgnatjevs/nginx-php5-fpm-xdebug-ffmpeg)

-----
Then run the following

MySQL server container:

```
  docker run -d -v  $PWD/mysqldb-files:/var/lib/mysql --name streamflix-mysql-server -p 3306:3306 -e MYSQL_ROOT_PASSWORD=admin -e MYSQL_DATABASE=streamflix-db --publish 6603:3306 centurylink/mysql
```

PHPMyAdmin container:

```
  docker run -d --name streamflix_admin --link streamflix-mysql-server:db -p 8080:80 phpmyadmin/phpmyadmin
```
MongoDB container:
```
  docker run -d -p 27017:27017 -p 28017:28017 --name mongodb_streamflix -v $PWD/mongodb-database/db:/data/db -v $PWD/mongodb-files:/var/lib/mongodb -e MONGODB_PASS="streamflix" tutum/mongodb mongod —smallfiles
```
Videoserver:
```
  docker run -d -p 1935:1935 -p 80:80 --name videoserver -v $PWD/nginx-videoserver/mp4:/var/mp4s -v $PWD/nginx-videoserver/www:/var/www vignatjevs/nginx-rtmp /usr/local/nginx-streaming/sbin/nginx
```
And finally, the site
```
  docker run --name streamflix -d -P -p 8082:80 -v $PWD/streamflix:/var/www/html -v $PWD/nginx-videoserver/mp4:/var/www/html/videos/mp4 -v $PWD/nginx-videoserver/mp4pics:/var/www/html/videos/videopics  --link streamflix-mysql-server:streamflix-mysql-server —link mongodb_streamflix:mongodb_streamflix --link videoserver:videoserver vignatjevs/nginx-php5-fpm-xdebug-ffmpeg
```
With such a setup as above, the main app can be accessed through <b>localhost:8082</b>, videoserver - <b>localhost:80</b>, PHPMyAdmin - <b>localhost:8080</b>.
Thanks to linking container available, we can access all the containers from StreamFlix if needed - either by shared volumes or using links: <b>'mongodb_streamflix'</b>, <b>'streamflix-mysql-server'</b>, <b>'videoserver'</b>. Also, phpmyadmin is connected to MySQL server through link <b>'db'</b>

I understand that I could use an opportunity of proper frameworks for my front, but this was not the task this time, although I spend quite a long times making site to look as it is.
Good luck and enjoy.
