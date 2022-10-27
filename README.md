# Pharmacy Management System Using PHP Laravel Framework

This project is a way to manage a pharmacy including sales , medicines , customers , ....etc

## Features

### Dashboard

- Overview of all things done in the current day

### Users

- Adding Users
- Updating Users
- Deleting Users

### Partners

- Adding Partners
- Updating Partners
- Deleting Partners

## Requirements

- Xampp
- Composer

## How to install

### Tutorials

- [How to install Xampp](https://www.youtube.com/watch?v=081xcYZKOZA)

- [How to install Composer](https://youtu.be/BGyuKpfMB9E)

- [How to create a database in phpmyadin](https://www.youtube.com/watch?v=IZCi0MTmeqA)

## Installing New Laravel Project To Get The pakages

- First create new laravel project

```console
composer create-project laravel/laravel example-app
```

- Open CMD and type the following command

```console
git clone https://github.com/MohammedElattar/Pharmacy.git
```

- Go to `Pharmacy` directory and copy all files in it

- paste it in  `example-app`

-Now you need to open `.env` file and you will find that block of code

```php
DB_DATABASE=pharmacy
```

- All you need to do is to change laravel to the Database name you've created in our `phpmyadmin` page

- next You need to run the migration file and seeders using the following command

-now open `Cmd` in Your `example-app` directory and Type These Commands

```console
php artisan migrate:refersh
```

```console
php artian db:seed
```

- Finally You Need To Start The Server

```console
php artisan serve
```

- Your Project Link

```console
http://127.0.0.1:8000
```

- And You Are ready Now to use the project

### Default Credentials

- Email `admin@admin.com`
- Password `admin`
