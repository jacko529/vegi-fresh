<p align="center"><img src="/public/images/logo.png"></p>


## About Vegi Fresh


To make this system work, create a database called 'foodassignment' import the sql file into php myadmin.

Go to the terminal (the directory the folder is in) and type composer install, this will install all of the dependencies 

edit the .env to what your db set up is, for xamp mysql 

the set up would be 

DB_CONNECTION=mysql<br>
DB_HOST=127.0.0.1<br>
DB_PORT=3306<br>
DB_DATABASE=foodassignment<br>
DB_USERNAME=root<br>
DB_PASSWORD=<br>

If you have the problem of dont have permission you could follow these instructions 



cd your_project_path<br>
php artisan cache:clear<br>
chmod -R 777 app<br>
chmod -R 777 storage<br>
composer dump-autoload<br>


To login I have created an account 
churchillj54@gmail.com<br>
Bottle1!<br>

Or just create a new user.