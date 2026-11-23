<?php
// The URL of the old media upload dialog for a type, post and tab; filtered by {$type}_upload_iframe_src.
$GLOBALS['post_ID'] = 5;
return array( get_upload_iframe_src( 'image' ), get_upload_iframe_src( 'media', 5, 'library' ) );
