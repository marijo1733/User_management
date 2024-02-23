Please check the official laravel installation guide for server requirements before you start.


Clone the repository

    git clone https://github.com/marijo1733/User_management.git

Switch to the repo folder

    cd user_management
Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

**TL;DR command list**

    git clone https://github.com/marijo1733/User_management.git
    cd user_management
    composer install
    cp .env.example .env
    php artisan key:generate
    
**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate
    php artisan serve

**TDD
Run TDD
./vendor/bin/phpunit and the file name   ex:./vendor/bin/phpunit --filter tests/Feature/Auth/AuthenticationTest.php
Check if user can log or not also if user can read update in the application


## credit
- [framework laravel](https://laravel.com/)
- [vue.js](https://vuejs.org/v3/guide/)
- [vuetify](https://vuetifyjs.com/en/)
- [SweetAlert](https://sweetalert2.github.io/)
- [Jwt](https://jwt-auth.readthedocs.io/en/develop/)
- [TDD](https://medium.com/simform-engineering/how-to-implement-tdd-in-laravel-and-why-it-is-important-22f889b89657)



