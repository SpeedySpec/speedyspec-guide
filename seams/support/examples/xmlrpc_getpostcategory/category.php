<?php
// The categories in an old XML-RPC post's <category> tag, as a list; else the post_default_category global.
$GLOBALS['post_default_category'] = 1;
return array( xmlrpc_getpostcategory( '<category>3,5</category>Body' ), xmlrpc_getpostcategory( 'Body' ) );
