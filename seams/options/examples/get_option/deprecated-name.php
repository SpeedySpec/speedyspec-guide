<?php
// A renamed option still reads, through its new name, and reports the old name as deprecated.
add_action( 'deprecated_argument_run', function ( $function_name, $message, $version ) {
	echo "$function_name $version";
}, 10, 3 );
update_option( 'disallowed_keys', 'spam' );
return get_option( 'blacklist_keys' );
