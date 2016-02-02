# Live Comment #

its a live comment system where anyone can comment and anyone can reply on that comment.

## Setup ##

* create a database 'live_comment' or what you like
* Go to 'config/database.php' and edit the mysql configuration to yours from line no. 9 to 12
* Now go to your installation url where you hosted the script i.e. http://your_server_url/live-comment/ and on first time it runs the migration.
* Go to index.php of your root and comment "require database/migrations/database_mig.php';"
* Now go to your browser and run again.
* All Done :)