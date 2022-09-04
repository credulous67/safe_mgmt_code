FROM localhost/safe_mgmt_fedora
RUN dnf install -y mariadb
COPY db_seeder.sh /db_seeder.sh
COPY v1_initial.sql /safe_mgmt.sql
ENTRYPOINT [ "bash", "-c", "/db_seeder.sh" ]
