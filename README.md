# Qafoo Symfony2 Workshop

This repository hosts a Symfony2 application used for Symfony Testing and
Doctrine2 workshops.  It is a derivation of the Symfony Standard Distribution
that is explicitly build for teaching Doctrine2 in a Symfony2 application.

## PHPUnit

pear channel-discover pear.phpunit.de
pear install --alldeps phpunit/phpunit

## Installation

When you have trouble intalling this application before a workshop, send me
an email to ``benjamin@qafoo.com`` with your errors/problems and I try to help you.

If you don't have Composer installed, go to: http://getcomposer.org/download/
Install Composer as described.

If you have Composer installed on your machine, go into your working directory
and call depending on:

    composer create-project qafoolabs/symfony2-workshop symfony-ws dev-master --prefer-dist

or

    php composer.phar create-project qafoolabs/symfony2-workshop symfony-ws dev-master --prefer-dist

This will create a new project with this application and download all the dependencies.

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

If you don't have PHP 5.4 yet make sure to change your `/etc/hosts`
file to contain a rule `127.0.0.1 sf2demo`

### Apache

Put the following into `/etc/apache2/sites-enabled/sf2demo` or
the Windows equivalent folder where your Apache Vhosts are located:

    <VirtualHost *:80>
        ServerName sf2demo

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

### Nginx

Put the following into `/etc/nginx/sites-enabled/sf2demo`:

    server {
        listen       *:80;
        server_name   sf2demo;

        set $index "index.php";

        root   /path/tp/project/web;
        index  $index;

        if (-f $request_filename) {
            break;
        }

        if (!-e $request_filename) {
            rewrite ^(.+)$ /$index$1 last;
            break;
        }
    }


## Important Note

This application is only for workshop purposes, it is neither secure nor sanely
configured production usage.

