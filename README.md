NGO Management System
=====

Simple Dairy Record Management System built with  php as a Mini Project for a college student

## Features
* Login ,Signup ,Edit  
* Manage Donors
* Admin Donors Volunteers and their roles
* Record Transactions Donated amout
* Donate payment 
* Add Volunteer Tasks
* View Tasks

## Roles
### 1.  Admin
Has access to all the features
### 2.  Donor
Can Donate
* View Donations
* Manage Transactions
* Donate Items

### 3.  Clerk
The Volunteer who is Conducting Tasks
* Record Tasks
* Add Tasks

# Software Requirements
* xampp
* browser

# Quick Guide

1. Clone this repo to your documents root e.g under `c:\xampp\htdocs\` on windows
2. Import the `ngo.sql` file to your database. (You can create a database called ngo using phpmyadmin and import this file into it)
3. open `pdo.php` file and enter your database settings
```php
$pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=ngo','root', '');
```
4. Open the url to your project e.g [http://localhost/Dairy](http://localhost/Dairy) and login with an already created account