# 489 Project: Cinema Management System

## Directory Structure

Here is a brief description of the structure of the system:

- Route definitions: all of the systems routes are define in `routes/web.php` and `routes/api.php` for use in web and AJAX respectively.
- Controllers: the directory `app/Http/Controllers/` contains all the controllers in our system.
- View: the code for the interface of our system is stored in `resources/views/`.  In that directory, view related to different models are placed in separate subdirectories, while code for custom components is placed in `resources/views/components`.
- Models: the different models in our system are placed in `app/Http/Models/`, while the code for creating the database is placed in `database/migrations/`.
- Randomly generated data:  the directories `database/seeders/` and `database/factories/` contain code used for filling the database with random data.
- Authentication middleware:  the code used for authentication and access control is all placed in `app/Http/Middlware/MyAuth.php`.
- Assets:  CSS and JavaScript code are placed under `public/assets/` so it can be access by the client.

## Running the system

In order to run the system, you have to first install the required framework.  You can do so by runinng the following command:

```
$ composer update
```

You have to also change `.env` file so it contains the appropriate information of the MySQL server.  After doing so, you may create the database and seed it with the following commands:

```
$ php artisan migrate
$ php artisan seed
```

Note that you will also have to place poster images in `storage/app/posters/` and make that storage available to the public.

When the system is ready you can serve it over `localhost` using the following command:

```
$ php artisan serve
```
