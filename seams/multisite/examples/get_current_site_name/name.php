<?php
// Gives a network object back unchanged; deprecated in 3.9.0, when networks gained their site_name.
function guide_report_deprecated( $function_name ) {
	echo "$function_name is deprecated\n";
}
add_action( 'deprecated_function_run', 'guide_report_deprecated' );
return get_current_site_name( (object) array( 'id' => 1, 'site_name' => 'Guide Network' ) )->site_name;
