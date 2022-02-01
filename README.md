## Getting Started

Installation

Please check the official laravel installation guide for server requirements before you start. <a href="https://laravel.com/docs/8.x/installation">Official Documentation</a>

Clone the repository
```sh
git clone https://github.com/technomads-in/budget_app_pwa.git
```
Switch to the repo folder
```sh
cd budget_app_pwa
```
Install all the dependencies using composer
<p>Project utilizes Composer to manage its dependencies. So, before using Project, make sure you have Composer update on your project.  <br />
The new minimum PHP version is now 7.3.0. <br />
Use Minimum PHP 7.3 and also available PHP 7.4  <br />
<code class="text-danger">composer update or composer install</code>  <br />

```sh
composer install
```
## Environment Setup
Copy the example env file and make the required configuration changes in the .env file
```sh
cp .env.example .env
```
Generate a new application key
```sh
php artisan key:generate
```

<p>In the .env file fill in the DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, and DB_PASSWORD options to match the credentials of the database you just created. This will allow us to run migrations and seed the database in the next step.</p>

```sh
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=database_name
DB_USERNAME=root
DB_PASSWORD=database_password
```


***New database tables cmd:

```sh
php artisan migrate:fresh
```

***Existing Database tables cmd: 
```sh
php artisan migrate
```

**** Storage link command 
```sh
php artisan storage:link
```

#API integration cmd: 
```sh
php artisan passport:install
```

Credentials Website : <br/>
url : /login <br />
Email: admin@gmail.com <br />
Pwd  : admin@123
