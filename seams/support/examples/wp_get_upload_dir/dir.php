<?php
// The uploads folder's paths and URLs, without making the folder for the month.
$dir = wp_get_upload_dir();
return array( $dir['baseurl'], $dir['subdir'] === '/' . gmdate( 'Y/m' ) || '' === $dir['subdir'], $dir['error'] );
