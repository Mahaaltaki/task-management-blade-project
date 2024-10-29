 Daily Task Management System
Project Overview

This project implements a basic daily task management system that allows users to add, edit, and delete tasks through a user interface built with Blade. Additionally, it includes an automatic daily email notification for each user, summarizing their pending tasks using a Cron Job. This README will guide you through the project's core components, setup requirements, and usage instructions.
Project Features

    Task Management:
        Users can view, add, update, delete, and manage their daily tasks through a clean, simple interface.
        Task fields include:
            title: Task title.
            description: Task details.
            due_date: The date the task should be completed.
            status: Task status, which can be set to either "Pending" or "Completed."

    User Management:
        User accounts are required for task access, ensuring only authenticated users can view and manage their tasks.
        User fields include:
            name: The user's name.
            email: The user's email address, used for authentication and email notifications.
            password: Encrypted user password for secure authentication.

    Automated Daily Email Notification:
        A Cron Job-based Command sends each user an email containing all their pending tasks for the day.
        The email feature leverages Mail and Queue for smooth delivery and task handling.

Project Requirements

    Laravel Framework
    Blade templates for the front end
    Eloquent ORM for database management
    Email configuration (SMTP server) for sending notifications

Model Structure

    Task:
        Fields: title, description, due_date, status
    User:
        Fields: name, email, password

UI Functionality (Blade Templates)

    Task Management:
        View Tasks: Displays a list of tasks, organized by their daily status.
        Add Task: Form for adding new tasks.
        Edit Task: Interface for updating task details.
        Delete Task: Option to remove completed or unnecessary tasks.
        Change Task Status: Toggle between "Pending" and "Completed" status.

The user interface also incorporates basic Blade directives:

    @if, @foreach for conditional logic and looping.
    @csrf to ensure security for form submissions.

Command and Cron Job Setup

    Daily Email Command: A Laravel Command configured with a Cron Job automatically emails users their pending tasks each day.
    Setup Instructions:
        Register the command to run daily in the app/Console/Kernel.php file.
        Test the command using:

        bash

        php artisan app:send-mail

Additional Features

    Authentication:
        Only registered users have access to the task management interface. This is configured with Laravel's authentication middleware.

    Data Caching:
        To enhance performance, frequently accessed tasks can be cached, reducing database load and speeding up response times.

    Error Handling:
        Built-in error handling ensures a smooth user experience, with custom error messages and fallbacks to guide users in case of system issues.

Getting Started
Installation

    Clone the repository:

    bash

git clone <repository-url>
cd <repository-folder>

Install dependencies:

bash

composer install

Create .env file and configure database settings and email configuration.

Run migrations to create necessary database tables:

bash

php artisan migrate

Start the application:

bash

    php artisan serve

Testing the Command

To manually test the daily email notification functionality, use:

bash

php artisan app:send-mail

Running the Cron Job

Add the following entry to your server's Cron configuration to trigger the daily email command:

bash

* * * * * php /path-to-your-project/artisan schedule:run >> /dev/null 2>&1

Notes

    Ensure that email notifications are set up correctly in the .env file to avoid sending errors.
    Caching and error handling can be further configured to suit your production environment.
    Test the entire system on a staging environment before deploying to production to validate email functionality and user authentication setup.

Happy task management!
