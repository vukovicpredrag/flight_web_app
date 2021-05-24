# Simple web application - Country management

Country informations and management

## Technologies
- Programing language: PHP 
- Framework: Laravel 8.40 

## Server Requirements

```
● PHP >= 7.3
● MYSQL
● PDO PHP Extension
● JSON PHP Extension
● Fileinfo PHP Extension
● Tokenizer PHP Extension

```


## Installation

 Install Composer Dependencies

```bash
composer install
```


Create a copy of your .env file

```bash
cp .env.example .env
```
*insert your database information (DB_PORT; DB_DATABASE; DB_USERNAME;DB_PASSWORD)



Generate an app encryption key

```bash
php artisan key:generate
```
Run database migrations

```bash
php artisan migrate
```


## Usage
Manage countries from  country list

Users are able to:
```
● Register / Ligin into application
● Get all countries
● Add country to favorite 
● Write a comment
● Get country information
● Get position on the map
● Get currency information


```




