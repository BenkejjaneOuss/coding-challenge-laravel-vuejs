# Coding Challenge with laravel/Vuejs
  A simple app with Laravel/Vue Js.
  
## Features UI
  - Authentication
  - List all items with infinite scroll pagination
  - Change password
  - add items. An item is a title, image and description.
  
## Features commandline
  - Create a new user from the command line `php artisan register:user`
  - Change password from the command line `php artisan user:change-password`

## Setup

  After you clone this project:
  
  1- Run `cp .env.example .env` to create a `.env` file
  
  2- Run `php artisan key:generate`
  
  3-Setup your Database information to your `.env` file :

  ``` bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=YourDatabaseName
DB_USERNAME=YourUsername
DB_PASSWORD=YourPassword
  ```
  4-Run `composer install`
  
  5-Run `php artisan migrate`
  
  6-Run `php artisan storage:link`
      
  7-Run `npm install`
  
  8-Run `npm run watch`
  
  9-Run `php artisan serve` and your app will be running on `localhost:8000`