# Qafoo Symfony2 Workshop

This repository hosts a Symfony2 application used for Symfony Testing and
Doctrine2 workshops.  It is a derivation of the Symfony Standard Distribution
that is explicitly build for teaching Functional Testing in a Symfony2 application.

## Installation

When you have trouble intalling this application before a workshop, send 
an email to ``contact@qafoo.com`` with your errors/problems and we try to help you.

If you don't have Composer installed, go to: http://getcomposer.org/download/
Install Composer as described.

If you have Composer installed on your machine, go into your working directory
and call depending on:

    composer create-project qafoolabs/symfony2-workshop symfony-ws dev-master --prefer-dist

or

    php composer.phar create-project qafoolabs/symfony2-workshop symfony-ws dev-master --prefer-dist

This will create a new project with this application and download all the dependencies.

### Composer during Workshop and Github Limitations

If you are executing the composer installation during the workshop, it is
possible Github limits the amount of calls through Composer by IP address. You have to create
an OAuth token to continue:

1. Create a Github account if you don't have one yet
2. From the Commandline call:

        curl -u 'your_github_user' -d '\{"note":"Workshop"\}' https://api.github.com/authorizations

3. Update your composer.json with the Token in the result:

        {
            "config": {
                "github-oauth": {
                    "github.com":"tokenhere"
                }
            }
        }

## Database Configuration

By default this example application will use SQLite as a database. To configure
another database to use during the workshop go to ``app/config/config.yml``
and change the configuration as explained in the file. You can uncomment
the specific sections for MySQL or PostgreSQL to change the database.

## Setup Webserver

Unless you have PHP 5.4 installed, you have to setup a webserver like
Apache or Nginx to serve your project.

With PHP 5.4 starting your Symfony application is as simple as calling:

    php app/console server:run

### Apache

Put the following into `/etc/apache2/sites-enabled/sf2workshop` or
the Windows equivalent folder where your Apache Vhosts are located:

    <VirtualHost *:80>
        ServerName sf2workshop

        DocumentRoot /path/to/project/web
        <Directory /path/to/project/web/>
            Options Indexes FollowSymLinks MultiViews
            AllowOverride None
            Order allow,deny
            Allow From all
            <IfModule mod_rewrite.c>
                RewriteEngine On
                RewriteCond %{REQUEST_FILENAME} !-f
                RewriteRule ^(.*)$ /index.php [QSA,L]
            </IfModule>
        </Directory>
    </VirtualHost>

Make sure to change your `/etc/hosts` file to contain a rule `127.0.0.1
sf2workshop`.

### Nginx

Put the following into `/etc/nginx/sites-enabled/sf2workshop`:

    server {
        server_name sf2workshop;
        root /var/www/project/web;

        location / {
            # try to serve file directly, fallback to rewrite
            try_files $uri @rewriteapp;
        }

        location @rewriteapp {
            # rewrite all to index.php
            rewrite ^(.*)$ /index.php/$1 last;
        }

        location ~ ^/(index|app|app_dev|config)\.php(/|$) {
            fastcgi_pass unix:/var/run/php5-fpm.sock;
            fastcgi_split_path_info ^(.+\.php)(/.*)$;
            include fastcgi_params;
            fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
            fastcgi_param HTTPS off;
        }

        error_log /var/log/nginx/project_error.log;
        access_log /var/log/nginx/project_access.log;
    }

Make sure to change your `/etc/hosts` file to contain a rule `127.0.0.1
sf2workshop`.

## Important Note

This application is only for workshop purposes, it is neither secure nor sanely
configured production usage.

