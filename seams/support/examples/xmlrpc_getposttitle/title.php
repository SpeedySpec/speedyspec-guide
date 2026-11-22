<?php
// The title in an old XML-RPC post's <title> tag, else the post_default_title global.
$GLOBALS['post_default_title'] = 'Untitled';
return array( xmlrpc_getposttitle( '<title>Hi</title>Body' ), xmlrpc_getposttitle( 'Body' ) );
