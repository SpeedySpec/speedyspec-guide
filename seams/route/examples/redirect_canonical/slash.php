<?php
// The canonical URL for a request, when it differs: here the trailing slash the permalink structure asks for. Non-GET requests, the admin, searches and previews are left alone; redirect_canonical can change or cancel it.
guide_permalinks( '/%postname%/' );
$add_slash = redirect_canonical( 'http://example.org/hello', false );
$same = redirect_canonical( 'http://example.org/hello/', false );
$_SERVER['REQUEST_METHOD'] = 'POST';
$post = redirect_canonical( 'http://example.org/hello', false );
$_SERVER['REQUEST_METHOD'] = 'GET';
add_filter( 'redirect_canonical', '__return_false' );
return array( $add_slash, $same, $post, redirect_canonical( 'http://example.org/hello', false ) );
