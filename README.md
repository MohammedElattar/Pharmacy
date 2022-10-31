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

## Setting Up The Project

### First You Need to clone the project from the following command

- Open CMD and type the following command

```console
git clone https://github.com/MohammedElattar/Pharmacy.git
```

- Go to `Pharmacy` directory :

```console
cd Pharmacy
```

- Now You Need To Install All Dependcies using `Composer`

```console
composer install
```

- last thing is to copy all information in `.env.example` file and paste it in `.env` file


- In `.env` file rename the `DB_DATABASE` to that db_name you've created in `phpmyadmin`


```php
DB_DATABASE= Your_Name_HERE
```

## Running The Migration to get db information


- Open `Cmd` And Type These Commands

```console
php artisan migrate:refersh
```

```console
php artian db:seed
```
## Running Your Project Live

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
