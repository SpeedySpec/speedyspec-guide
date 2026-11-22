<?php
// When the site language changes, the stored rules are emptied, so they are rebuilt with the translated bases. Here the write is caught to show it.
function guide_stored_rules() {
	return array( '^old/?$' => 'index.php?old=1' );
}
add_filter( 'pre_option_rewrite_rules', 'guide_stored_rules' );
function guide_stop_saving_rules( $value ) {
	echo 'update rewrite_rules: ', var_export( $value, true ), "\n";
	throw new RuntimeException( 'stopped before the database' );
}
add_filter( 'pre_update_option_rewrite_rules', 'guide_stop_saving_rules' );
try { wp_flush_rewrite_rules_on_site_language_change(); } catch ( RuntimeException $e ) { return $e->getMessage(); }
