Docker image of Concrete5.8 with Apache2.4 and PHP 5.6 based on the official Debian Jessie image
# Docker for Concrete 5
Currently Supports Concrete 5 Version 8~

## Tags Available
latest (which will always be the highest version number)
8.3.2,
8.3.1,
8.3.0,
8.2.1,
8.2.0,
8.1.0,
8.0.3,
8.0.2,
8.0.1,
8.0.0,

## Specialised Usage
You can hot-swap concrete 5 versions 8 or above. For example, when you run the :latest tag, when the latest version is updated and the container is restarted the new concrete version will be installed. Please note if your website breaks on restart (as a result of an updated concrete version) please use a lower tagged version of concrete to restore your website as quickly as possible.

## Usage
### Create a minimal Data Container
MariaDB will use the initially empty /var/lib/mysql directory and Concrete5 will use /var/www/html and /etc/apache2, which will be populated by the docker-entrypoint script.

```
docker create -it --name c5_DATA_1 \
-v /var/lib/mysql \
-v /var/www/html \
-v /etc/apache2 \
tianon/true true
```
The container does not need to be started or running for sharing its data.

###Create a Database
This initializes one database for use with Concrete5. Remember replacing the the_root_password and the_db_user_password with real passwords.

```
docker run -d --name db \
--restart=always \
--volumes-from c5_DATA_1 \
-e MYSQL_ROOT_PASSWORD=the_db_root_password \
-e MYSQL_USER=admin \
-e MYSQL_PASSWORD=the_db_user_password \
-e MYSQL_DATABASE=c5db \
mariadb
```
### Run Concrete5
It will be linked to the MariaDB: The link between the c5_db and the c5_web container causes the /etc/hosts file in the Concrete5 container to be continually updated with the current IP of the c5_db container.
```
docker run -d --name=c5_web_1 \
--restart=always \
--volumes-from c5_DATA_1 \
--link db:db \
-p 80:80 \
-p 443:443 \
chriswayg/concrete5.7
```

## Composer
I highly Suggest using composer to run this setup. To do so use something similar to below (changing the tag to the one you require).
```
$ cd c5
$ cat docker-compose.yml
db:
  image: mariadb
  restart: always
  environment:
  - MYSQL_ROOT_PASSWORD=ROOT_PASSWORD
  - MYSQL_USER=root
  - MYSQL_PASSWORD=USER_PASSWORD
  - MYSQL_DATABASE=c5db
  # host volume
  volumes:
    - ./data/var/lib/mysql:/var/lib/mysql

web:
  image: concrete-docker:latest
  restart: always
  ports:
  - "80:80"
  - "443:443"
  links:
  - db
  log_opt:
    max-size: "512k"
    max-file: "50"
  # host volumes
  volumes:
    - ./data/etc/apache2:/etc/apache2
    - ./data/var/www/html:/var/www/html

$ docker-compose up -d
```

### Concrete5 Setup
Visit your Concrete5 site at https://localhost/ for initial setup.

On the setup page, set your site-name and admin user password and enter the following
```
	Database Information:
	Server:          db
	MySQL Username:  the_db_user_name
	MySQL Password:  the_db_user_password
	Database Name:   c5db
```
### Data will persist
The Concrete5 and MariaDB application containers can be removed (even with docker rm -f -v), upgraded and reinitialized without loosing website or database data, as all website data is stored in the DATA container. (Just do not delete the DATA container;)

To find out where the data is stored on disk, check with ``` docker inspect c5_DATA_1 | grep -A1 Source ```

### Backup Containers with Data in Volumes
If you are storing your data in Docker volume containers, take a look at the ``` docker-clone ``` script: It will clone a set of containers including all its data. There is more info regarding it here on stackoverflow. The docker-clone script still needs to be complemented to be more generally useful beyond this project. It is heavily commented, so try it out and see, if it meets your needs. I would welcome any suggestions for improvements.

### Database management or fix problems with phpMyAdmin
``` docker run --rm --link c5_db_1:mysql -p 12345:80 nazarpc/phpmyadmin
```
Login as MYSQL_USER with your password in MYSQL_PASSWORD.

## License
This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later version.
