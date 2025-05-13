# Laravel ECOM

## Overview

This Ecom system is built with Laravel to manage Products

## Installation Guide

### Prerequisites

Ensure you have the following installed:

-   PHP (>= 8.1)
-   Composer
-   MySQL or PostgreSQL (or any other database supported by Laravel)
-   Laravel 10+
-   Node.js & NPM (for frontend dependencies)

### Steps to Setup the Project

1. **Clone the repository**:
    ```bash
    git clone https://github.com/Akshayp2002/e-com-machine-test
    cd sales-dock
    ```
2. **Install dependencies**:
    ```bash
    composer install
    npm install && npm run dev
    ```
3. **Set up environment variables**:
    - Copy `.env.example` to `.env`
    ```bash
    cp .env.example .env
    ```
    - Update the database configuration in `.env`:
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=e-com
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
    ```
4. **Generate application key**:
    ```bash
    php artisan key:generate
    ```
5. **Run migrations and seeders**:
    ```bash
    php artisan migrate --seed
    ```
6. **Start the development server**:
    ```bash
    php artisan serve
    ```
    The application should now be running at `http://127.0.0.1:8000`

## Default Login Credentials

After running the seeders, you can log in using the default credentials:

-   **Admin**:
    -   Email: `admin@example.com`
    -   Password: `password`
-   **Manager**:

    -   Email: `manager@example.com`
    -   Password: `password`
-   **Customer1-5**:

    -   Email: `customer1@example.com`
    -   Password: `password`