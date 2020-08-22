# victr_test
1. I used PHP 7.3.12, MySQL 8.0.18, Laravel 7.25.0, JQuery 3.5.1, JQuery jsGrid 1.5.3, and Laravle Guzzle 7.0. 
2. Check out this code in directory of itself
3. Modify the MySQL configuration to connect to your database. 
4. Navigate into the directory and run the Laravel database migration to set up the database table.
5. Clear composer, view, cache and config via artisan commands.
6. While you can run the app in any web server I created this using the Laravel PHP server, running it via the artisan command.
7. Access the application via http://127.0.0.1:8000/


THe database structure is as follows:
'CREATE TABLE `victr` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `repo_id` int(11) NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `repo_url` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_date` datetime NOT NULL,
  `last_push_date` datetime NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `num_of_stars` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci'

THe application is MVC:
View is the resources\view\victr.blade.php. It calls jsgrid remote (so you have to have internet connectivity for it to work. if doing this for real it should be downloaded and installed in the public/js folder)
Controller is app\Http\Controllers\Victr
  --has 4 methods:
     index (retrieves repos info from github, calls function that truncates db, calls function that stores new info, calls it, returns it blade)
     store (takes the data from github passed to it and stores in database)
     delete (truncates the database table when called)
     retrieve (pulls data out of database)
public/js has
    jquery library downloaded
    js file for the calling the API to retrieve data and pass back to blade 
Database migration file is found in databse/migraton/2020_08_20_000000_create_victr_table
    
    
THese are just the basic funcitonality. I didn't include theming/styling, comments/notes, a lot of time on performance/usabliity/bells/whistles/elegant exception, etc due to time limitations. 
    
