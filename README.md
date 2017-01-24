# streamflix
DevOps assignment 2017/2017

StremFlix - dockerized streaming system

consists of:
[Ubuntu 14.04 LTS + NGINX + PHP5-FPM + xdebug + ffmpeg + composer + PHP-FFMpeg ](https://hub.docker.com/r/vignatjevs/nginx-php5-fpm-xdebug-ffmpeg/)
[MongoDB ](https://hub.docker.com/r/tutum/mongodb/)
[PHPMyAdmin ](https://hub.docker.com/r/phpmyadmin/phpmyadmin)
[MySQL Server](https://hub.docker.com/r/centurylink/mysql)
[NGINX+rtmp](https://hub.docker.com/r/vignatjevs/nginx-rtmp/)


To run the application, either pull the above and run the following:

-----

Start with pulling images from Docker Hub:
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
  docker run -d -p 27017:27017 -p 28017:28017 --name mongodb_streamflix -v $PWD/mongodb-files:/var/lib/mongodb -e MONGODB_PASS="streamflix" tutum/mongodb mongod —smallfiles
```
Videoserver:
```
  docker run -d -p 1935:1935 -p 80:80 --name videoserv -v $PWD/nginx-videoserver/mp4:/var/mp4s -v $PWD/nginx-videoserver/www:/var/www vignatjevs/nginx-rtmp /usr/local/nginx-streaming/sbin/nginx
```
And finally, the site
```
  docker run --name streamflix -d -P -p 8082:80 -v $PWD/streamflix:/var/www/html -v $PWD/nginx-videoserver/mp4:/var/www/html/videos/mp4 -v $PWD/nginx-videoserver/mp4pics:/var/www/html/videos/videopics  --link streamflix-mysql-server:mysqldb —link mongodb_streamflix:mongodb --link videoserv:videoserver vignatjevs/nginx-php5-fpm-xdebug-ffmpeg
```
With such a setup as above, the main app can be accessed through <b>localhost:8082</b>, videoserver - <b>localhost:80</b>, PHPMyAdmin - <b>localhost:8080</b>.
Thanks to linking container available, we can access all the containers from StreamFlix if needed - either by shared volumes or using links: <b>'mongodb'</b>, <b>'mysqldb'</b>, <b>'videoserver'</b>. Also, phpmyadmin is connected to MySQL server through link <b>'db'</b> 

I understand that I could use an opportunity of proper frameworks for my front, but this was not the task this time, although I spend quite a long times making site to look as it is.
Good luck and enjoy.
  
