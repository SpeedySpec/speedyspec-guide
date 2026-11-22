<?php
// url_to_postid filters the URL first.
add_filter( 'url_to_postid', fn( $url ) => 'http://example.org/?p=99' );
return url_to_postid( 'http://example.org/anything/' );
