# Symfony GraphQL API

## env options (.env.local)

    APP_ENV
    DATABASE_URL
    DEV_CLIENT_API_TOKEN
    API_ITEMS_PER_PAGE

## Install

    composer install
    php bin/console doctrine:database:create
    php bin/console doctrine:schema:update --force
    php bin/console doctrine:fixtures:load --append --group=users
    php bin/console doctrine:fixtures:load --append --group=products

## Create API user

    php bin/console app:create-api-user username api_key

## Show API Token

    php bin/console app:show-api-user-token username

## Start server

    sh start_server.sh

## Tests

    php ./vendor/bin/phpunit

## Bibliography

* [Quick start](https://github.com/overblog/GraphQLBundle/blob/master/docs/definitions/quick-start.md)
* [Schema](https://github.com/overblog/GraphQLBundle/blob/master/docs/definitions/schema.md)
* [Resolver](https://github.com/overblog/GraphQLBundle/blob/master/docs/definitions/resolver.md)
* [Debug](https://github.com/overblog/GraphQLBundle/blob/master/docs/definitions/debug/index.md)
* [Access control in GraphQL using Symfony](https://dev.to/bornfightcompany/access-control-in-graphql-using-symfony-io)
* [Annotations & PHP 8 attributes](https://github.com/overblog/GraphQLBundle/blob/master/docs/annotations/index.md)
* [Optimizations for entity fetching for Doctrine ORM to address N+1 queries problem](https://github.com/malef/associate)
* [Client GraphiQL](https://github.com/overblog/GraphiQLBundle)

## Copyrights

Copyright (c) Rafał Mikołajun 2021.
