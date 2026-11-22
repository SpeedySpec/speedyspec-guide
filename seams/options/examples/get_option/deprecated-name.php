<?php
// A renamed option still reads, through its new name, and reports the old name as deprecated.
function guide_report_deprecated_argument( $function_name, $message, $version ) {
	echo "$function_name $version";
}
add_action( 'deprecated_argument_run', 'guide_report_deprecated_argument', 10, 3 );
update_option( 'disallowed_keys', 'spam' );
return get_option( 'blacklist_keys' );
