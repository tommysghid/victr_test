1. Used Laravel 7.25.0, MySQL 8, PHP 7.3.12, JQuery 2.5.1, jsGrid 1.5.3, and Guzzle 7.0
2. I ran the Laravel PHP server via the artisan command (php artisan serve) to create this instead of using Apache, Nginx, etc.
3. The application is accessible by http://127.0.0.1:8000/
4. YOu can access the API (that populates the grid) directly http://127.0.0.1:8000/api/github_repos/all
5. The architecture/files are as follows:
    app/Http/Controllers/Victr.php
      had 4 methods: 
      --delete which truncates the database table when called
      --retrieve which gets the data out of the database table when called
      --store which puts the data in the database table when called
      --index which
        a) gets the latest data from github via the github query
        b) truncates the local database table data
        c) stores the recently retrieved data from github in the database table
        d) retrieves the data from the database table
        e) returns the data back to the viewer/blade for jsgrid to use
    resources/views/victr.blade.php
       --the blade where the js/css/html is called/created to present the data from the database
    public/js/jquery-3.5.1.min
       --downloaded so the app works without internet connectivity
    public/js/victr_listing.js
       --application js file that is called from the viewer/blade, gets the database data from the api/database, returns it to be formatted in the div as a grid. 
    database/migrations/2020_08_20_000000_create_victr_table
       --what creates the table to store the data from github which is also called to show on the view
    routes/api/
       --api to access the database table data directly
    routes/web
       --where the blade is defined which the server loads when you access the root page
       
       
Due to time limitations I was not able to work a lot on usability, themeing, bells/whistles, etc. I know the database pwd is in the file. I left it there as an example for you. Of course that would never be done on an actual project. This database is local host. I didn't know what you meant by "click through to the details" so I just hyperlinked the row's repo url to github. 
