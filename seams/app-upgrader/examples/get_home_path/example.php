<?php
// The absolute path of the folder holding WordPress's index.php and .htaccess, which differs from ABSPATH when WordPress is in its own folder.
return get_home_path() === ABSPATH;
