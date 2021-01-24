CHOPE TEST
----------

Based on Yii 2 Advanced Project Template.
The project will includes three tiers: api, portal, and console, each of which is a separate Yii application.

Requirements
------------
- Git.
- Docker.

Starting the Services
---------------------
After you clone the repository simply just run `docker-compose up`.
Add `127.0.0.1  chope.test` & `127.0.0.1    api.chope.test` to your hosts filer.
It will take sometime first time, until all required libraries installed.

DIRECTORY STRUCTURE
-------------------

```
common
    config/              contains shared configurations
    models/              contains model classes used in both api and portal
    tests/               contains tests for common classes    
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    runtime/             contains files generated during runtime
api
    config/              contains api configurations
    controllers/         contains Web controller classes
    models/              contains api-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for api application    
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
portal
    assets/              contains application assets such as JavaScript and CSS
    config/              contains portal configurations
    controllers/         contains Web controller classes
    models/              contains portal-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for portal application
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains portal widgets
vendor/                  contains dependent 3rd-party packages
```
