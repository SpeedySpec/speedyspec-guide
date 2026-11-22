<?php
// url_to_postid filters the URL first.
function guide_replace_url( $url ) {
	return 'http://example.org/?p=99';
}
add_filter( 'url_to_postid', 'guide_replace_url' );
return url_to_postid( 'http://example.org/anything/' );
