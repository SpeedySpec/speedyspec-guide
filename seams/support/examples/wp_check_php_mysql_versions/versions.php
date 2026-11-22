<?php
// Stops the request with a 500 error page when PHP is older than WordPress requires, or when no database extension is loaded and there is no db.php drop-in; otherwise nothing.
wp_check_php_mysql_versions();
return 'versions are fine';
