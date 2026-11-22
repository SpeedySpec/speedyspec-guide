<?php
// When the home URL changes only from http to https, records that content needs migrating (not for a fresh site).
// $wpdb stands in only to pass sanitize_option() its charset check; option saves are caught on pre_update_option.
$GLOBALS['wpdb'] = new class { public $options = 'wp_options'; public function strip_invalid_text_for_column( $t, $c, $v ) { return $v; } };
add_filter( 'pre_update_option', function ( $value, $option, $old ) { echo "save $option: ", var_export( $value, true ), "\n"; return $old; }, 10, 3 );
add_filter( 'pre_option_fresh_site', fn() => '0' );
add_filter( 'pre_option_https_migration_required', fn() => '' );
wp_update_https_migration_required( 'http://example.org', 'https://example.org' );
return null;
