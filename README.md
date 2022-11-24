# Safe Management System (SMS)
This is a web based application to manage safes and their contents to satisfy PCI DSS and PCI PIN Security requirements

## To start containers
```
cd ~/docker/safe_mgmt
sudo docker-compose up -d –build
```
## To stop containers
``` 
cd ~/docker/safe_mgmt
sudo docker-compose stop 
```
## Accessing appllications
[SMS main application](http://127.0.0.1:8080)

[phpMyAdmin](http://127.0.0.1:8081)
## Container manifest
### safe_mgmt_fedora_1
Is a container instantiation of my safe_mgmt_fedora image (the same image that is used as a base for php_httpd and db_seeder), this is based on an official Fedora 37 image with a known checksum
This is the Dockerfile
```
# Fedora 37 container image using known good digest
FROM registry.fedoraproject.org/fedora@sha256:50e70b6e9baa89323352cc4caf5a072dd2f613af35390c95308a315c2075b6cf
RUN dnf install -y iproute procps iputils nmap-ncat lsof less
RUN dnf update -y 
ENTRYPOINT [ "tail", "-f", "/dev/null" ]
```
### safe_mgmt_mariadb_1
This container is the main database server running mariadb. It is running [a standard docker official image](https://github.com/MariaDB/mariadb-docker/blob/6a881f0800e0771afd9a291cb28b5ffef4322121/10.10/Dockerfile) for MariaDB version 10
### safe_mgmt_phpmyadmin_1
This container is running phpMyAdmin to help manage the database. It is running [a standard official docker image](https://github.com/phpmyadmin/docker/blob/b936b8ebd118cddaab53da31266dc016d70b43fe/apache/Dockerfile) for phpMyAdmin version 5 using apache
### safe_mgmt_php_httpd_1
Is based on my safe_mgmt_fedora image and is using php-fpm on apache to run the application
### safe_mgmt_db_seeder_1
Is based on my safe_mgmt_fedora image, it's purpose is to connect to the main database and check if it is empty, and if so populate it with the base / test data using the db_seeder.sh script




# This is currently in development

>Basic login system working with password exiry and change  
- [ ] Need to add new user creation with password generation and email  
- [ ] Need password change screen to generate / suggest password using **pwqgen**  
- [ ] Need to implement logout if idle for 10 mins (configure in profile?) 


Currently having an issue where password change does not seem to be calling password_change_script.php after submit.
Also trying to work out how to call logout.php from index.html (maybe change to index.php?), to ensure logged out if some start playing with URL.
Also need to ensure that if user logs in but password is expired, that loggedin is set to FALSE so that if someone
chenges password_change.php to main_menu.php they are not logged in .. instead get dumped back to inde.html
