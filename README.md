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
## Container manifest
### safe_mgmt_fedora_1
Is a container instantiation of my safe_mgmt_fedora image (the same image that is used as a base for php_httpd and db_seeder), this is based on an official Fedora 37 image with a known checksum
### safe_mgmt_mariadb_1
This container is the main database server running mariadb. It is running a standard docker official image for MariaDB version 10
### safe_mgmt_phpmyadmin_1
This container is running phpMyAdmin to help manage the database. It is running a standard official docker image for phpMyAdmin version 5 using apache
### safe_mgmt_php_httpd_1
Is based on my safe_mgmt_fedora image and is using php-fpm on apache to run the application
### safe_mgmt_db_seeder_1
Is based on my safe_mgmt_fedora image, it's purpose is to connect to the main database and check if it is empty, and if so populate it with the base / test data using the db_seeder.sh script




# This is currently in development

>Basic login system working with password exiry and change  
- [ ] Need to add new user creation with password generation and email  
- [ ] Need password change screen to generate / suggest password using **pwqgen**  
- [ ] Need to implement logout if idle for 10 mins (configure in profile?) 



