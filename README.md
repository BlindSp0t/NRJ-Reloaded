NRJ-Reloaded
============

Mush - NRJ Reloaded


This code should be working on a local server right away if you have the database and you have your php.ini setting MOD_REWRITE turned ON.

There should be 3 file to edit in order to deploy the website :
- application\config\config.php (setting the default url)
- application\config\database.php (setting the remote db server's information)
- index.php (root folder) to set the environment to production instead of development (hide errors).
