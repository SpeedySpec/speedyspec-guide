<?php
// Whether a persistent object cache is in use; given a value, sets it and gives the old one.
$was = wp_using_ext_object_cache( true );
$now = wp_using_ext_object_cache();
wp_using_ext_object_cache( $was );
return array( $was, $now );
