# Library Management System

## Requirements

-   PHP 8.2
-   Composer
-   Laravel 11
-   MySQL
-   Passport
-   l5-swagger
-   Redis
-   Laravel Pint
-   Laravel-Telescope
-   phpunit

## Installation

1.  If you are ready with PHP 8.2, Composer, MySQL, Redis (also install PHP Redis Extension).
    You can clone this repository.
    `git clone https://github.com/breakfast12/library-management-system.git`
2.  Install Composer dependencies: `composer install`.
3.  Regenerate Composer autoload files: `composer dump-autoload`.
4.  Copy .env.example and rename file to `.env` and `.env.testing` and then configure your environment variables.
    besides configuring the database, also configure the cache (redis) like this to `.env` and `.env.testing`:
    ```
        SESSION_DRIVER=redis
        CACHE_STORE=redis
        CACHE_DRIVER=redis
        REDIS_CLIENT=phpredis
        REDIS_HOST=127.0.0.1
        REDIS_PASSWORD=null
        REDIS_PORT=6379
    ```
    Change the `APP_ENV` content in the `.env.testing` to testing
    Fill `API_SECRET_KEY` in `.env` and `.env.testing`
5.  Generate application key: `php artisan key:generate`.
    (Note: after run `php artisan key:generate` copy value APP_KEY of `.env` to APP_KEY of `.env.testing`)
6.  Migrate DB and seed table:
    -   `php artisan migrate`
    -   `php artisan db:seed`
7.  Install Key Passport: `php artisan passport:keys`
8.  Publish the Passport configuration file: `php artisan vendor:publish --tag=passport-config`
9.  Create necessary storage links: `php artisan storage:link`
10. Generate Swagger documentation: `php artisan l5-swagger:generate`
11. Publish Laravel Telescope: `php artisan telescope:publish`
12. Copy phpunit.xml.example to `phpunit.xml` and then configure your environment testing.
    ```<php>
            <server name="APP_ENV" value="testing"/>
            <server name="BCRYPT_ROUNDS" value="4"/>
            <server name="CACHE_DRIVER" value="array"/>
            <server name="DB_CONNECTION" value="mysql"/>
            <server name='DB_USERNAME' value="your_username_db"/>
            <server name='DB_PASSWORD' value="your_password_db"/>
            <server name="DB_DATABASE" value="db_testing"/>
            <server name="MAIL_MAILER" value="array"/>
            <server name="QUEUE_CONNECTION" value="sync"/>
            <server name="SESSION_DRIVER" value="array"/>
            <server name="TELESCOPE_ENABLED" value="false"/>
        </php>
    ```

## Running the Application

1. Run the application: `php artisan serve`
2. Access the application at: http://127.0.0.1:8000 or http://localhost:8000
3. Access Swagger documentation at: http://localhost:8000/api/documentation or http://127.0.0.1:8000/api/documentation
4. Access Telescope for monitor the application performance: http://127.0.0.1:8000/telescope or http://localhost:8000/telescope

## Running Tests

1. Run unit test: `php artisan run:tests --env=testing`

## Note:

-   Create 2 DB, 1 for development and 1 for unit test
-   API_SECRET_KEY in `.env` and `.env.testing` for create bearer token (example: abc, project123, or something)
-   Make sure the redis is running

[Performance Tuning and Design Patterns](performance-tuning-design-pattern.md)
