#!/bin/bash
cd /var/www/html/install

php cli_install.php install --db_hostname mysql \
                            --db_username root \
                            --db_password opencart \
                            --db_database opencart \
                            --db_driver mysqli \
                  					--db_port 3306 \
                            --username admin \
                            --password admin \
                            --email admin@ecomcharge.com \
                            --http_server http://127.0.0.1:8080/
