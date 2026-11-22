<?php
// Ends the request because the database can't be reached: the db-error.php drop-in when there is one, else an error page with a 500.
return guide_dies( 'dead_db' );
