FROM localhost/safe_mgmt_fedora
RUN dnf install -y httpd php php-mysqlnd php-common php-gd php-xml php-mbstring supervisor libpwquality cracklib-dicts passwdqc-utils
RUN mkdir /run/php-fpm
RUN chown root:apache /run/php-fpm
RUN chmod 775 /run/php-fpm
COPY php_dev.ini /etc/php.ini
#RUN mkdir /run/supervisor
COPY supervisord.conf /etc/supervisord.conf
# decided to use pwqcheck rather that pwscore
#COPY pwquality.conf /etc/security/pwquality.conf
COPY passwdqc.conf /etc/passwdqc.conf
#ENTRYPOINT /usr/sbin/httpd -DFOREGROUND
ENTRYPOINT /usr/bin/supervisord -c /etc/supervisord.conf -n
#ENTRYPOINT tail -f /dev/null
