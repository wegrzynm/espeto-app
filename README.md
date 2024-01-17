
# Espeto App

## Server requirements:
   - Linux: min. 1GB RAM,
   - [Composer](https://getcomposer.org/download/)
   - PHP: >=8.1,
   - MySql,
   - Apache or nginx
   - Other [Symfony requirements](https://symfony.com/doc/current/setup.html#technical-requirements)
## Installation

Install ``Espeto App`` with git and composer
##
#### 1. Clone Repository
```git
$ gh repo clone wegrzynm/espeto-app
```
#### 2. Enter project folder
```bash
$ cd espeto-app
```
#### 3. Install App with Composer
```bash
$ composer install
```
#### 4. Setup database
Suggested: create copy of ``.env`` file and name it ``.env.local`` this way you can store your secrets securly, and You will avoid problems when downloading updates from Git Repository
#####
In ``.env.local`` file setup connection with database
```.env
DATABASE_URL="mysql://user:password@127.0.0.1:3306/espeto_app"
```
#### 5. Create database
```bash
$ php bin/console doctrine:database:create
```
```bash
$ php bin/console doctrine:migrations:migrate
```
```bash
$ php bin/console doctrine:fixtures:load
```
#### 6. Setup apache server
Setup Apache server according to documenation and download all nessecary extensions for php
Example configuration file for apache HTTPS server. Remember to obtain your ssl certificate before:
```.conf
<IfModule mod_ssl.c>
    <VirtualHost *:443>
        ServerName example.com
        DocumentRoot /var/www/espeto-app/public

        <Directory /var/www/espeto-app/public>
            AllowOverride All
            Require all granted

            FallbackResource /index.php
        </Directory>

        ErrorLog ${APACHE_LOG_DIR}/error.log
        CustomLog ${APACHE_LOG_DIR}/access.log combined

        SSLEngine on

        # Allow custom headers using the headers module
        <IfModule mod_headers.c>
            Header always set Access-Control-Allow-Origin "*"
            Header always set Access-Control-Allow-Methods "POST, GET, PUT, DELETE, OPTIONS"
            Header always set Access-Control-Allow-Headers "Authorization, Content-Type"
            # Add any additional custom headers here
        </IfModule>

        Include /etc/letsencrypt/options-ssl-apache.conf
        SSLCertificateFile /etc/letsencrypt/live/example.com/fullchain.pem
        SSLCertificateKeyFile /etc/letsencrypt/live/example.com/privkey.pem
    </VirtualHost>
</IfModule>
```
#### 7. Everything should work now
