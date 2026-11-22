<?php
// Whether a user option is set for the current site only; deprecated in 4.9.0.
function guide_report_deprecated( $function_name, $replacement, $version ) {
	echo "$function_name is deprecated since $version" . ( $replacement ? " for $replacement" : '' ) . "\n";
}
add_action( 'deprecated_function_run', 'guide_report_deprecated', 10, 3 );
update_user_option( 1, 'guide_pref', 'x' );
return is_user_option_local( 'guide_pref', 1 );
