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

- [How to create a database in phpmyadin](https://www.youtube.com/watch?v=IZCi0MTmeqA)

- Open CMD and type the following command

```console
git clone https://github.com/MohammedElattar/Pharmacy.git
```

- Go to your project directory

-Now you need to open `.env` file and you will find that block of code

```php
DB_DATABASE=pharmacy
```

- All you need to do is to change laravel to the Database name you've created in our `phpmyadmin` page

- next You need to run the migration file and seeders using the following command

```console
php artisan migrate&php artian db:seed
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
