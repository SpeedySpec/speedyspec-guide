<?php
// The avatar URLs of a user, email or comment, by size, for the REST sizes.
$urls = rest_get_avatar_urls( 'admin@example.org' );
return array( array_keys( $urls ), str_contains( $urls[48], 's=48' ) );
