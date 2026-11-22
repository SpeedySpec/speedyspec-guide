<?php
// Adds slashes to the request's GET, POST, COOKIE and SERVER values and rebuilds REQUEST from GET and POST, as WordPress has always done.
$_GET = array( 'q' => "it's" );
$_POST = array();
wp_magic_quotes();
return array( $_GET['q'], $_REQUEST['q'] );
