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

- First you need to composer From [HERE](https://getcomposer.org/download/) and install it based on your machine

- Next You Need To Install Xampp On Your Machine From the [HERE](https://www.apachefriends.org/download.html) and install it

- Start Your Xampp Apache Server By Clicking Apache And MYSQL like that

![Image](https://codezips.com/wp-content/uploads/2020/07/xamppstart.png)

- next you need to open your CMD and run the following command

- Go ahead to your browser and type `http://localhost/phpmyadmin`

- Click on new and type a name of your new DataBase and click **Create**

- Now we are ready to make a new laravel project

- Open Your CMD and type the following command and click **Enter**

```console
composer create-project --prefer-dist laravel/laravel project_name
```

- Go ahead to your project directory by typing

```console
cd project_name
```

-Now you need to open `.env` file and you will find that block of code

```php
DB_DATABASE=laravel
```

- All you need to do is to change laravel to the Database name you've created in our `phpmyadmin` page

- next You need to run the migration file and seeders using the following command

```console
php artisan migrate&php artian db:seed
```

- And You Are ready Now to use the project

### Default Credentials

- Email `admin@admin.com`
- Password `admin`
