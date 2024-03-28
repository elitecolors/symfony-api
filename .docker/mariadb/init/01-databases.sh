#!/bin/bash

echo "### Creating api Test database"
mysql -u root -p$MYSQL_ROOT_PASSWORD -e "CREATE DATABASE IF NOT EXISTS api_db_test"

mysql -u root -p$MYSQL_ROOT_PASSWORD -e "GRANT ALL PRIVILEGES ON api_db_test.* TO $MYSQL_USER@'%'"

echo "### Creating api database"
mysql -u root -p$MYSQL_ROOT_PASSWORD -e "CREATE DATABASE IF NOT EXISTS api_db"

mysql -u root -p$MYSQL_ROOT_PASSWORD -e "GRANT ALL PRIVILEGES ON api_db.* TO $MYSQL_USER@'%'"

