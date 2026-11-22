<?php
// Deprecated in 6.9.0 for mb_convert_encoding(): converts ISO-8859-1 to UTF-8. (PHP 8.2+ deprecates its own too; WordPress defines it when PHP has none.)
function guide_print_deprecated_function( $function_name, $replacement, $version ) {
	echo "$function_name $version $replacement\n";
}
add_action( 'deprecated_function_run', 'guide_print_deprecated_function', 10, 3 );
return array( bin2hex( utf8_encode( "caf\xE9" ) ), bin2hex( utf8_decode( 'café' ) ) );
