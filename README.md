# Docker Symfony Comics Store

Docker-symfony gives you everything you need for developing Symfony application. This complete stack run with docker and [docker-compose](https://docs.docker.com/compose/).

## Installation

1. Install [docker](https://docs.docker.com/compose/install/) and [docker-compose](https://docs.docker.com/compose/install/#install-compose)

2. Build/run containers with (with and without detached mode)

    ```bash
    $ docker-compose build
    $ docker-compose up -d
    ```

3. Update your system host file (add comics-store.com)

    ```bash
    # UNIX only: get containers IP address and update host (replace IP according to your configuration) (on Windows, edit C:\Windows\System32\drivers\etc\hosts)
    $ sudo echo $(docker network inspect bridge | grep Gateway | grep -o -E '[0-9\.]+') "comics-store.com api.comics-store.com" >> /etc/hosts
    ```

    **Note:** For **OS X**, please take a look [here](https://docs.docker.com/docker-for-mac/networking/) and for **Windows** read [this](https://docs.docker.com/docker-for-windows/#/step-4-explore-the-application-and-run-examples) (4th step).

4. Prepare Symfony app
    1. Update .env

        ```
        # .env
        DATABASE_URL=mysql://root:root@db:3307/store
        ```

    2. Composer install & create database

        ```bash
        $ docker-compose exec store bash
        $ composer install
        # Symfony4
        $ php bin/console doctrine:database:create
        $ php bin/console doctrine:schema:update --force
        $ php bin/console doctrine:fixtures:load --no-interaction
        ```

5. Enjoy :-)

## Usage

Just run `docker-compose up -d`, then:

* Symfony app: visit [comics-store.com](http://comics-store.com)  

## How it works?

Have a look at the `docker-compose.yml` file, here are the `docker-compose` built images:

* `db`: This is the MySQL database container,
* `store`: This is the PHP-FPM and Apache2 container in which the application volume is mounted,

This results in the following running containers:

```bash
$ docker-compose ps

       Name                     Command               State              Ports            
------------------------------------------------------------------------------------------
comic-store-apache   docker-php-entrypoint /bin ...   Up      5233/tcp, 0.0.0.0:80->80/tcp
comic-store-db       docker-entrypoint.sh mysqld      Up      0.0.0.0:3307->3306/tcp  
```

## Useful commands

```bash
# bash commands
$ docker-compose exec store bash

# Composer (e.g. composer update)
$ docker-compose exec store composer update

# Symfony commands
$ docker-compose exec store /var/www/html/bin/console cache:clear # Symfony4
$ docker-compose exec store bash
$ php bin/console cache:clear

# Retrieve an IP Address (here for the nginx container)
$ docker inspect --format '{{ .NetworkSettings.Networks.dockersymfony_default.IPAddress }}' $(docker ps -f name=nginx -q)
$ docker inspect $(docker ps -f name=store -q) | grep IPAddress

# MySQL commands
$ docker-compose exec db mysql -uroot -p"root"

# F***ing cache/logs folder
$ sudo chmod -R 777 var/cache var/log var/sessions # Symfony4

# Check CPU consumption
$ docker stats $(docker inspect -f "{{ .Name }}" $(docker ps -q))

# Delete all containers
$ docker rm $(docker ps -aq)

# Delete all images
$ docker rmi $(docker images -q)
```

## FAQ

* Got this error: `ERROR: Couldn't connect to Docker daemon at http+docker://localunixsocket - is it running?
If it's at a non-standard location, specify the URL with the DOCKER_HOST environment variable.` ?  
Run `docker-compose up -d` instead.

* Permission problem? See [this doc (Setting up Permission)](http://symfony.com/doc/current/book/installation.html#checking-symfony-application-configuration-and-setup)

* How to config Xdebug?
Xdebug is configured out of the box!
Just config your IDE to connect port  `9001` and id key `PHPSTORM`

* Permission problem MySql?
  sudo chmod -R 777 data/db