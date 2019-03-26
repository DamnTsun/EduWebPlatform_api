# EduWebPlatform_api
This is the API / backend for the educational web platform.

# Prerequisites
In order to run this solution you will require the following:
* An Apache web server.
* PHP 7.1 installed and configured on your server.
  * System was developed with PHP 7.1. Support for newer releases of PHP has **not** been checked.
* MySQL.
  * (Optional) - Some method of interacting with MySQL, such as phpmyadmin.
* A Google account.
* A Facebook account.

# Setting up the solution

**MySQL related**
1. Open area for interacting with MySQL databases. (such as phpmyadmin)
2. Create a new user with appropriate privilege levels, or note the credentials of an existing user.
3. Go to the import tab for importing files. Import the ```schema.sql``` file from the root directory of the solution.
4. Import any initial data into the database.
Note that the first admin user in the system must manually be set. Either by signing in and manually changing the privilegeLevel_id field of the user to ```2```, or by manually inserting the user record along with the users social media account id, account type, and a privilegeLevel_id of ```2```

**Google Sign-In related**
1. Go to the Google developer console using your Google account. (https://console.developers.google.com/)
2. Create a new project and then view it.
3. Generate a set of API keys.
4. Make note of both the 'Client ID' and 'Client Secret' keys you are given.

**Facebook Sign-In related**
1. Go to the Facebook developers page using your Facebook account. (https://developers.facebook.com/)
2. Create a new app and then view it.
3. Select the Integrate Facebook Login option.
4. Make note of both the 'App ID' and 'App Secret' keys you are given.


**PHP related**

Files / Filepaths mentioned will be relatively to the base directory of the solution.
1. Enter the terminal / commandline, navigate to base directory of solution, type ```composer install``` to install dependencies.
2. Open ```core/reference.php```. Update the values of the environment variables. See below.
    * ```$_ENV['db_host']``` ```$_ENV['db_name']``` ```$_ENV['db_user']``` ```$_ENV['db_pass']``` - Change to database host (URL) / name of database / username of database user / password of database user.
    * ```$_ENV['dir_base']``` - Change to URL of root directory of solution. Such as ```https://domain.com/```.
    * ```$_ENV['google_client_id']``` ```$_ENV['google_client_secret']``` - Change to client id / client secret keys generated earlier using the Google developers console.
    * ```$_ENV['facebook_client_id']``` ```$_ENV['facebook_client_secret']``` - Change to app id / app secret keys generated earlier using the Facebook developers page.
    * ```$_ENV['JWT_Hmac_key']``` - Change to a hmac key for use with the Sha256 algorithm. This is used to encrypt the authorization tokens that users are sent. This key should be at least 128-bit.
3. Remove the following lines of code from 'index.php' before putting the solution into production. These include errors in the output, which is used when developing / testing the solution. However end-users should not see these.
```php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
```


**Apache config related**

1. Open ```.htaccess```. Fine the line named ```RewriteBase```. Change the value to the filepath component of the URL used to access the solution, so if accessing it at ```https://domain.com/edu/```, change it to ```/edu/```. If accessing it from ```https://domain.com/```, change it to ```//```, etc.

Problems may be encountered on some servers due to the HTTP headers used for CORS (Cross Origin Resource Sharing) not be set correctly. (The server prevents the PHP code setting the headers or similar).

Add the following code to the bottom of the ```.htaccess``` file. Hopefully this will solve this issue.
```
Header always set Access-Control-Allow-Origin "{{frontend_url}}"
Header always set Access-Control-Allow-Methods "GET POST DELETE OPTIONS"
Header always set Access-Control-Allow-Headers "idToken"
Header always set Access-Control-Allow-Credentials "true"
```
Make sure to replace ```{{frontend_url}}``` with the URL of the frontend that will be using this API.
