# EduWebPlatform_api
This is the API / backend for the educational web platform.

# Prerequisites
In order to run this solution you will require the following:
* A web server, such as Apache or Nginx
* PHP installed and configured for the server. (Version support unknown. Solution built and tested using 7.1)
* The PHP dependency manager 'Composer' installed and configured to work with your PHP exectuable.
* MySQL.
* A Google account.


# Setting up the solution
**MySQL related**

1. Open area for interacting with MySQL databases. (such as phpmyadmin)
2. If desired, create a new user with whichever privilege levels you wish.
3. Go to the import tab for importing files. Import the 'schema.sql' file from the root directory of the solution.
4. Import 'testData.sql' from the root directory of solution. Alternatively if not testing, import the initial data of the platform via a method of your choosing.

**Google OAuth2 related**

1. Go to the Google developers console (at Google)
2. Generate a new set of api keys, naming it whatever you wish.
3. Note down the client id and client secret values you are given.

**PHP / code related**

Files / Filepaths mentioned will be relatively to the base directory of the solution.
1. Enter the terminal / commandline, navigate to base directory of solution, type 'composer install' to install dependencies.
2. Open 'core/reference.php'. Update the values of the environment variables. See below.
    * $_ENV['db_host'/'db_name'/'db_user'/'db_pass'] - Change to host / name of database and username / password of database user you are acting as.
    * $_ENV['dir_base'] - Change to uri of root directory of solution. Such as 'htt...://domain.com/'.
    * $_ENV['google_client_id'/'google_client_secret'] - Change to client id / client secret values you generated earlier at the Google developers console.
3. Remove the following lines of code from 'index.php' before putting the solution into production. These include errors in the output, which is used when developing / testing the solution. However end-users should not see these.
```php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
```
4. Open '.htaccess'. Find the line 'RewriteBase'. Change the value to the filepath component of the uri used to access the solution. So if accessing it at 'domain/', change it to '/'. If accessing it as 'domain/api', change it to '/api/'.
