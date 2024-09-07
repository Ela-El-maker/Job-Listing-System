# Job Portal Web Application
## Overview
This is a robust job portal web application built using the Laravel PHP framework. The platform is designed to connect job seekers with employers, offering a seamless experience for posting job opportunities, applying for positions, and managing job applications. The system is user-friendly, scalable, and secure, ensuring both candidates and employers have a smooth experience throughout the recruitment process.

## Features
User Registration and Authentication: Separate sign-up and login functionalities for both job seekers and employers.
Job Posting Management: Employers can create, update, and delete job postings, as well as view applications for the jobs posted.
Job Search Functionality: Job seekers can search for jobs using various filters (e.g., location, job type, experience).
Profile Management: Both job seekers and employers can manage and update their profiles.
Application Management: Job seekers can apply for jobs, and employers can track job applications.
Job Alerts: Notification system for job seekers to receive alerts on new job postings.
Resume Upload: Job seekers can upload resumes for streamlined applications.
Admin Dashboard: An administrative panel for managing users, job postings, and reviewing platform performance.
Security: Robust security measures, including password hashing, authentication, and authorization, are implemented to protect user data.
## Tech Stack
Backend: Laravel 10.x (PHP 8.x)
Frontend: Blade templating engine, HTML5, CSS3, JavaScript (with optional Vue.js/React.js integration for advanced interactions)
Database: MySQL (or PostgreSQL), using Laravel's Eloquent ORM for database operations
Deployment: Apache/Nginx, PHP-FPM, with an option for Dockerized environments
Version Control: Git for version control, with GitHub/GitLab for repository management
## Setup Instructions
## Prerequisites
PHP 8.x or higher
Composer
MySQL or PostgreSQL
Node.js and npm/yarn (for frontend package management)
Git
Installation Steps
1. Clone the Repository:
    ```bash
    git clone git@github.com:Ela-El-maker/Job-Listing-System.git
    ```
2. Install Dependencies: Install the PHP dependencies using Composer:
    ```bash
    composer install
    ```
3. Install the frontend dependencies using npm/yarn:
    ```bash
    npm install
    ```
4. Configure Environment Variables: Create a .env file by copying from .env.example and adjust the settings according to your environment (e.g., database credentials):
    ```bash
    cp .env.example .env
    ```
5. Generate Application Key: Generate a Laravel application key to ensure secure encryption:
    ```bash
    php artisan key:generate
    ```
6. Database Setup: Set up your database and run the migrations to create the necessary tables:
    ```bash
    php artisan migrate
    ```
7. Seed the Database (Optional): Seed your database with test data:
   ```bash
    php artisan db:seed
    ```
8. Compile Frontend Assets: Compile the frontend assets using Laravel Mix:
   ```bash
   npm run dev
    ```
9. Serve the Application: Serve your Laravel application locally:
    ```bash
    php artisan serve
    ```
10. Run automated tests using Laravel’s testing suite:
    ```bash
    php artisan test
    ```
## Deployment
For production deployment, make sure to configure your web server (Apache/Nginx) properly and set up an SSL certificate for secure communication.
Use tools like Laravel Forge, Envoyer, or Docker for efficient deployment.

## Database System Design

![drawSQL-image-export-2024-09-07](https://github.com/user-attachments/assets/726fcfa8-7571-4811-8f17-0867ecfc411f)
