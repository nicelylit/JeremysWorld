#!/bin/zsh

DB_CONTAINER=jeremysworld-db-1
DB_PASSWORD=somewordpress
DB_NAME=wordpress
BLOG_HOME=/Users/mengjiaming/Workspaces/Blog

# two steps to process db_dump.sql
# 1. replace mjm1990.com with localhost
# 2. replace https://localhost with http://localhost

# import db_dump.sql into database
# https://dev.mysql.com/doc/refman/8.0/en/mysql-command-options.html#option_mysql_database
docker exec -i ${DB_CONTAINER} mysql --binary-mode=1 --default-character-set=utf8 -uroot -p${DB_PASSWORD} ${DB_NAME} < ${BLOG_HOME}/Database/Backup/db_dump.sql