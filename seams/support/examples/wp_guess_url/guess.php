<?php
// The site's URL: WP_SITEURL when defined, else guessed from the request's host and the path of the script, as when installing.
$_SERVER['SCRIPT_FILENAME'] = ABSPATH . 'index.php';
$_SERVER['PHP_SELF'] = '/blog/index.php';
$root = wp_guess_url();
$_SERVER['REQUEST_URI'] = '/blog/wp-admin/install.php';
return array( $root, wp_guess_url() );
