CREATE USER IF NOT EXISTS 'keycloak'@'%' IDENTIFIED BY 'keycloak';
GRANT ALL ON `keycloak`.* TO 'keycloak'@'%';
FLUSH PRIVILEGES;
