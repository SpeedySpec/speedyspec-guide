<?php
// Switches the home and site URLs to https, and switches them back when the site isn't then using HTTPS.
// $wpdb stands in only to pass sanitize_option() its charset check; option saves are caught on pre_update_option.
$GLOBALS['wpdb'] = new class { public $options = 'wp_options'; public function strip_invalid_text_for_column( $t, $c, $v ) { return $v; } };
function guide_catch_option_save( $value, $option, $old_value ) {
	echo "save $option: ", var_export( $value, true ), "\n";
	return $old_value;
}
add_filter( 'pre_update_option', 'guide_catch_option_save', 10, 3 );
return wp_update_urls_to_https();
