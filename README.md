Course Creation Web App (Laravel)
=================================

A sleek web app to create **courses** with multiple **modules**, and each module can have multiple **content items** --- built with Laravel, vanilla JS, and jQuery.

* * * * *

🚀 Project Overview
-------------------

This project lets users create courses with:

-   Unlimited **modules** per course

-   Unlimited **content items** per module (text, images, videos, links, etc.)

-   Frontend and backend validation to keep things tight

-   Data stored in a relational database (courses, modules, content linked properly)

-   User-friendly UI with nested views for easy content management

-   Error handling with clear user feedback

* * * * *

⚙️ Features
-----------

-   Create new courses with title, description, category, and more

-   Add unlimited modules inside each course, each with its own title

-   Add unlimited content inside each module with multiple fields

-   Validations on frontend (required fields, formats) and backend

-   Store all data with correct relationships in the database

-   Error handling for validation errors and database exceptions

* * * * *

🛠️ Setup Instructions
----------------------

1.  Clone the repo

    ```
    git clone https://github.com/hossainmdismail/courese-task.git
    cd your-repo

    ```

2.  Install PHP dependencies

    ```
    composer install

    ```

3.  Setup your `.env` file

    ```
    cp .env.example .env

    ```

    Configure your database credentials and other env variables.

4.  Generate app key

    ```
    php artisan key:generate

    ```

5.  Run migrations

    ```
    php artisan migrate

    ```

6.  Serve the app

    ```
    php artisan serve

    ```

    Visit `http://localhost:8000` in your browser.

* * * * *

📝 Notes
--------

-   Validations happen on both client and server side

-   Relationships: One course → many modules → many content items

-   Error messages are user-friendly

-   Designed for scalability and maintainability

* * * * *

Thank you for reviewing my project!
