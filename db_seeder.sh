#! /bin/bash
# wait for MySQL container to start
sleep 10

res=$(mysql -ss -h mariadb -u root -prootpwd -e 'SELECT COUNT(DISTINCT `table_name`) FROM `information_schema`.`columns` WHERE `table_schema` = "safe_mgmt"; ')

echo $res
if [ $res -eq 0 ]; then
  echo "safe_mgmt database empty, restoring"
  newres=$(mysql -ss -h mariadb -u root -prootpwd -D safe_mgmt < /safe_mgmt.sql)
fi
