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

- [Composer](https://www.youtube.com/watch?v=BGyuKpfMB9E)

- [Xampp](https://www.youtube.com/watch?v=081xcYZKOZA)

- First you need to composer From [HERE](https://getcomposer.org/download/) and install it based on your machine

- Next You Need To Install Xampp On Your Machine From the [HERE](https://www.apachefriends.org/download.html) and install it

- Start Your Xampp Apache Server By Clicking Apache And MYSQL like that

![Image](https://codezips.com/wp-content/uploads/2020/07/xamppstart.png)

- next you need to open your CMD and run the following command

- Go ahead to your browser and type `http://localhost/phpmyadmin`

- Click on new and type a name of your new DataBase and click **Create**

- Now you need to type the following command

```console
git clone https://github.com/MohammedElattar/Pharmacy.git
```

- Go to your project directory

-Now you need to open `.env` file and you will find that block of code

```php
DB_DATABASE=laravel
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
