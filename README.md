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

### Experiencing Github API Rate Limitations?

If you are executing the composer installation during the workshop, it is
possible Github limits the amount of calls through Composer by IP address. You
have to create an OAuth token to continue:

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

If you dont have 5.4, see Symfony documentation on (how to configure
with a webserver)[http://symfony.com/doc/current/cookbook/configuration/web_server_configuration.html].

Don't forget to adjust your `/etc/hosts` to point to the workshop webserver.
