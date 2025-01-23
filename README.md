<h2 align='center'>Mbuy</h2>

#### Table of contents

-   [About](#about)
-   [Features](#features)
-   [Installation Instructions](#installation-instructions)
-   [Laravel Components In This Project](#laravel-components-in-this-project)

### About

This project is a Shopping API built with Laravel 9, utilizing Laravel Fractal, Laravel Passport, and Guzzle for a robust and scalable architecture. The API facilitates the complete shopping process, including user management, product registration, and transactions.
### Key Features:
- 
-   User Registration & Verification: Users can create accounts, and the system sends a verification email to activate their accounts.
-   Seller & Buyer Roles: Users can register as sellers or buyers
-   Product Management: Sellers can register products for sale within the system.
-   Transaction Handling: Buyers can purchase products. Each transaction records the product_id, buyer_id, quantity, and currency.
This API ensures a seamless and secure shopping experience, supporting user authentication, email verification, and role-based functionality.
### Installation Instructions

1. Run `git clone https://github.com/MahdiKhadimi/mbuy`
2. Create a MySQL database for the project
    - `create database mbuy;`
3. Download dependency by run `composer install`

4. From the projects root run `php artisan serve`
5. Configure your `.env` file
6. From the projects root folder run `php artisan migrate`
7. From the projects root folder run `php artisan db:seed`
8. From the projects root folder run `composer dump-autoload`

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
