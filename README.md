# A Laravel Movie Task For Cube Media Company

This is a Laravel Project With Mysql Database 

## Requirements
To run this project locally, you need to have the following installed on your machine:

PHP >= 8.1
Composer
A database system (MySQL)

## Setup Instructions
Follow these steps to set up the project locally.

### Clone the Repository
 
git clone https://github.com/takwa81/MovieRatingTask.git
cd MovieRatingTask


### Install Dependencies
Run the following commands to install the required PHP dependencies:

composer install


## Configure the Environment
Copy the example environment file and make the necessary configuration adjustments specific to your local setup:

cp .env.example .env


Then, open .env in your favorite text editor and update the database settings and any other environment variables.

## Generate Application Key
Set the application key for the Laravel application:

php artisan key:generate

## JWT Authentication Setup

My project uses JWT for handling authentication. The necessary packages and configurations have been set up for you. Here's a brief overview of how to use it:

## Generating JWT Secret

Generate a new JWT secret key:

php artisan jwt:secret

### Run Migrations and Seeders
Create the database schema and populate it with any initial data:


php artisan migrate

php artisan db:seed

## Serve the Application
Start the Laravel development server:

php artisan serve

You can now access the application in your web browser at http://localhost:8000.



