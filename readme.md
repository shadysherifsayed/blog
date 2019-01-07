# Blog App
### Prerequisites
* [Composer](https://getcomposer.org/download/ "Download Composer")

-----------------------------------------------------------------------------------

### Installation
This is a guide that explains how to run this app on your local machine. Kindly, follow the following steps:

  1. First step is to install all dependencies needed, use `composer install` command to install all needed dependencies from `composer.json`

  2. The main database name is `mumm_blog`, if you want to change it open `.env` file, and modify it with your DB credintials
 ```sh
// Change those lines
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mumm_blog
DB_USERNAME=root
DB_PASSWORD=
 ```
 
 3. The testing database name is `mumm_blog_testing`, if you want to change it open `phpunit.xml` file, and modify it with your DB credentials
 ```sh
 // Change those lines
 <env name="DB_CONNECTION" value="mysql" />
<env name="DB_DATABASE" value="mumm_blog_testing" />
<env name="DB_USERNAME" value="root" />        
<env name="DB_PASSWORD" value="" />
 ```
  4. Setting up your DB connection **and** creating the DB **manually**, simply run this command `php artisan migrate` to migrate tables.
  
  
  5. You may run this command `php artisan storage:link` to create the symbolic link between storage folder and public folder.
  
  6. Lastly, you may run `php artisan serve` command. This command will start a development server at `http://localhost:8000`

----------------------------------------------------------------------
### Notes

###### Database Seeding

I have created a seeder for the database to create dummy data for all application models(Post, Category, User, and Admin),
simply you could run `php artisan migrate:fresh --seed`, or if you have already `migrated` the tables you could run `php artisan db:seed`, and after that `50 posts`, `10 categories`, `1 admin`, and also `1 user` will be created.
```
  // Admin data
  [
      'name' => 'Super Admin',
      'username' => 'admin',
      'email' => 'super@admin.com',
      'password' => 123456,
  ]
  
  // User data
  [
      'name' => 'Shady Sherif',
      'username' => 'shady',
      'email' => 'shady@user.com',
      'password' => 123456,
  ]
```

###### Admin Login

To login as an `admin`, the url will be `APP_URL\admin\login`

----------------------------------------------------------------------

### Help

##### Error #1
While migrating if you encounters this error
`PDOException::("SQLSTATE[42000]: Syntax error or access violation: 1071 Specified key was too long; max key length is 767 bytes")`

_**Solution**_
Go to `app->Providers->AppServiceProvider.php` and add this line to `boot` method.
``` sh
use Illuminate\Support\Facades\Schema;
public function boot()
    {
        Schema::defaultStringLength(191);
    }
```

##### Error #2
`SQLSTATE[42S01]: Base table or view already exists:`
_**Solution**_
Simply run the following commands
``` sh
$ php artisan migrate:fresh
```
