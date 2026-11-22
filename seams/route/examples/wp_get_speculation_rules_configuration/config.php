<?php
// For logged-out visitors on a site with pretty permalinks: prefetch, conservative eagerness. wp_speculation_rules_configuration can change it; null turns it off, and immediate eagerness is never used.
$plain = wp_get_speculation_rules_configuration();
guide_permalinks( '/%postname%/' );
$pretty = wp_get_speculation_rules_configuration();
function guide_prerender_immediately() {
	return array( 'mode' => 'prerender', 'eagerness' => 'immediate' );
}
add_filter( 'wp_speculation_rules_configuration', 'guide_prerender_immediately' );
return array( $plain, $pretty, wp_get_speculation_rules_configuration() );
