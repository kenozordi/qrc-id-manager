## About qrc-id-manager

Identity Management App that uses QR (Quick Response) Codes to manage membership and privilege

## How to set-up

Run the following commands

-   `cp .env.example .env` (This is to create a .env file by making a copy of .env.example. This command should be executed at the root of the project folder)
-   `composer install`
-   `php artisan key:generate`
-   `php artisan migrate`
