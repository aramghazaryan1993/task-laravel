# create databases
CREATE DATABASE IF NOT EXISTS `local_laravel`;

# create task_laravel-docker2 user and grant rights
CREATE USER 'root'@'db' IDENTIFIED BY 'root';
GRANT ALL PRIVILEGES ON *.* TO 'task_laravel-docker2'@'%';

