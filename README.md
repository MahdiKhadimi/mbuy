<h2 align='center'>Mbuy</h2>

#### Table of contents

-   [About](#about)
-   [Features](#features)
-   [Installation Instructions](#installation-instructions)
-   [Laravel Components In This Project](#laravel-components-in-this-project)

### About

In this project laravel 9 with laravel-fractal, laravel-passport and guzzle have used, it is a shopping API that has created to manage all shopping process, at the first step user creates account and system sends email to the user, this email is used to verify user account, user can be seller or buyer.
seller can register product in the system to sell product, once the product register in the system other users can buy the product, a transaction takes place when the user buys the product.
product_id, buyer_id, quantity and currency are registered in the transaction.

### Features

-   Creat Account By Users
-   Users Verify Email Address
-   User Restore Deleted Account Token
-   CRUD (Create, Read, Update, Delete) Users Management
-   Soft Deleted Users Management System
-   CRUD (Create, Read, Update, Delete) Products Management
-   Soft Deleted Products Management System
-   CRUD (Create, Read, Update, Delete) Categories Management
-   Soft Deleted Categories Management System
-   Buyer Product Report
-   Buyer Category Report
-   Buyer Seller Report
-   Buyer Transaction Report
-   Category Buyer Report
-   Category Seller Report
-   Category Product Report
-   Category Transaction Report
-   Product Buyer Report
-   Product Buyer Transaction Report
-   Product Category Report
-   Product Transaction Report
-   Seller List And Seller Show
-   Seller Buyer Report
-   Seller Category Report
-   Seller Product Report
-   Seller Transaction Report
-   Transaction Show And Transaction List
-   Transaction Category Report
-   Transaction Seller Report

### Installation Instructions

1. Run `git clone https://github.com/MahdiKhadimi/mbuy`
2. Create a MySQL database for the project
    - `create database mbuy;`
3. From the projects root run `php artisan serve`
4. Configure your `.env` file
5. From the projects root folder run `php artisan migrate`
6. From the projects root folder run `php artisan db:seed`
7. From the projects root folder run `composer dump-autoload`

### Laravel Components In This Project

-   Route
-   Controller
-   Model
-   Middleware
-   Data Model Binding
-   Scope
-   Mail
-   Migration
-   Factory
-   Seeder
-   Request
-   Validation
-   Authorization By Policy
-   Using Laravel Passport For Authentication
-   File Storage
-   Event
-   Relationship
-   Accesor&Mutator
-   Laravel Fractal For Data Transformer
-   Custome Pagination
