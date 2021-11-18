# Symfony GraphQL API

This module is to be used to create a list of locations by users - we can assume,
that it is about Events that will take place at the address indicated and will last at the specified address
time interval (date from - to). The module returns a list of added events, and the user
can find any by entering the name of the event in the search engine.

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

## Queries

Events List:

```
query {
  events_list(limit:100, page:1) {
    events {
      id
      name
      slug
      email
      streetAddress
      city
      country
      zipcode
      dateFrom
      dateTo
    }
  }
}
```

Single Event:

```
query {
  event(id:"bca2bbaf-f44e-4e06-a6cb-4922ccf245da") {
    id
    name
    slug
    email
    streetAddress
    city
    country
    zipcode
    dateFrom
    dateTo
  }
}
```

## Mutations

Create Event

```
mutation {
  event_create(input: {
    name: "Jakieś wydarzenie"
    streetAddress: "al. Warszawska 12"
    country: "PL"
    city: "Olsztyn"
    zipcode: "10-082"
    email: "jan@kowalski.dev"
    dateFrom: "2020-01-01"
    dateTo: "2020-02-25"
  }) {
    id
  }
}
```

# Client for dev

After start server open `http://localhost:3000/graphiql`.

![GraphiQL.png](https://github.com/mikoweb/symfony-graphql-api/raw/master/markdown/static/GraphiQL.png)

## Bibliography

* [Introduction to GraphQL](https://graphql.org/learn/)
* [Quick start](https://github.com/overblog/GraphQLBundle/blob/master/docs/definitions/quick-start.md)
* [Schema](https://github.com/overblog/GraphQLBundle/blob/master/docs/definitions/schema.md)
* [Resolver](https://github.com/overblog/GraphQLBundle/blob/master/docs/definitions/resolver.md)
* [Debug](https://github.com/overblog/GraphQLBundle/blob/master/docs/definitions/debug/index.md)
* [Access control in GraphQL using Symfony](https://dev.to/bornfightcompany/access-control-in-graphql-using-symfony-io)
* [Annotations & PHP 8 attributes](https://github.com/overblog/GraphQLBundle/blob/master/docs/annotations/index.md)
* [Annotations reference](https://github.com/overblog/GraphQLBundle/blob/master/docs/annotations/annotations-reference.md)
* [Validation](https://github.com/overblog/GraphQLBundle/blob/master/docs/validation/index.md)
* [The Arguments Transformer service](https://github.com/overblog/GraphQLBundle/blob/master/docs/annotations/arguments-transformer.md)
* [Optimizations for entity fetching for Doctrine ORM to address N+1 queries problem](https://github.com/malef/associate)
* [Client GraphiQL](https://github.com/overblog/GraphiQLBundle)
* [Adding a GraphQL API to your Symfony Flex application](https://symfony.fi/entry/adding-a-graphql-api-to-your-symfony-flex-app)

## Copyrights

Copyright (c) Rafał Mikołajun 2021.
