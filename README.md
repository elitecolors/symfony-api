# PHP symfony environment with JSON REST API example
Docker environment (based on official php and mysql docker hub repositories) required to run Symfony with JSON REST API example.

[![Actions Status](https://github.com/systemsdk/docker-symfony-api/workflows/Symfony%20Rest%20API/badge.svg)](https://github.com/systemsdk/docker-symfony-api/actions)
[![CircleCI](https://circleci.com/gh/systemsdk/docker-symfony-api.svg?style=svg)](https://circleci.com/gh/systemsdk/docker-symfony-api)
[![Coverage Status](https://coveralls.io/repos/github/systemsdk/docker-symfony-api/badge.svg)](https://coveralls.io/github/systemsdk/docker-symfony-api)
[![Latest Stable Version](https://poser.pugx.org/systemsdk/docker-symfony-api/v)](https://packagist.org/packages/systemsdk/docker-symfony-api)
[![MIT licensed](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)


## Requirements
* Docker version 18.06 or later
* Docker compose version 1.22 or later
* An editor or IDE

Note: OS recommendation - Linux Ubuntu based.

## Components
1. Nginx 1.25
2. PHP 8.2 fpm
3. MySQL 8
4. xdebug
4. Symfony 6
5. RabbitMQ 3
6. Elasticsearch 7
7. Kibana 7
8. Redis 7

## Start project
1. docker-compose build
2. docker-compose up -d


### Access to phpserver container 
docker exec -it -u www-data api-phpserver /bin/bash
