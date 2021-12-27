# create databases
CREATE DATABASE IF NOT EXISTS `test`;

#create task_laravel-docker user and grant rights
CREATE USER 'root'@'db' IDENTIFIED BY 'root';
GRANT ALL PRIVILEGES ON *.* TO 'test'@'%';
