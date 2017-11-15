# Test app
UI for send messages system

## Table of contents
* [Get the source code](#get-the-source-code)
* [Installing / Getting started](#installing-getting-started)
* [Configuration](#configuration)
* [Developing](#developing)
    * [Built with](#built-with)
    * [Prerequisites](#prerequisites)
    * [Building](#building)
* [Deployment](#deployment)
* [Tests (optional)](#tests-optional)
* [Style Guide (optional)](#style-guide-optional)
* [API Reference (optional)](#api-reference-optional)
* [Database (optional)](#database-optional)
* [License](#license)


## Get the Source Code
Clone the repository using the following command:
```
git https://github.com/KlebanAndrew/vitech.git your-project-folder
```

## Installing / Getting Started
 Configure virtual host to /public folder
 ```
 <VirtualHost appname.l:80>
         DocumentRoot "/home/www/you-folder/public/"
         ServerName "appname.l"
         ServerAlias appname.l www.appname.l
 </VirtualHost>

```
```
cd ./your-project-folder
composer install
npm install
cd ./your-project-folder/public
bower install
```

## Configuration

Set the permissions to the directories:
```
cd ./your-project-folder
sudo chmod -R 755 ./storage
sudo chmod -R 755 ./bootstrap/cache
```

Configure an environment:
- copy `.env.example` to `.env`
- configure `.env` file

To run all of your outstanding migrations, execute the Artisan command:
```
php artisan migrate
```

## Developing

### Built With
- [angularjs 1.5.6](https://angular.io/)
- [Laravel 5.4](https://laravel.com)

### Prerequisites
- PHP >= 5.5
  - OpenSSL PHP Extension
  - PDO PHP Extension
  - Mbstring PHP Extension
  - Tokenizer PHP Extension
  - XML PHP Extension
  - PHP Imagick Extension
- Apache2
- MySQL >=5.4
- Node.js 8.9
- NPM >= 5.4
- grunt >= 1.0.4

### Building
Build the application (compile the scripts, styles, assets):
```
grunt
```
## Database (optional)
In root folder you find database database.sql dump with test data