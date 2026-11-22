<?php
// The stored rules from the rewrite_rules option, or freshly built and saved when they're missing; with plain permalinks, none. Here the stored option answers.
function guide_stored_rules() {
	return array( '^x/?$' => 'index.php?x=1' );
}
add_filter( 'pre_option_rewrite_rules', 'guide_stored_rules' );
$plain = $GLOBALS['wp_rewrite']->wp_rewrite_rules();
$r = guide_permalinks( '/%postname%/' );
return array( $plain, $r->wp_rewrite_rules() );
