<?php
// Rules are stored, not rebuilt each request: flush them when the plugin is switched on and off, never on every load.
// The example turns on pretty permalinks, as most sites have them.
global $wp_rewrite;
$wp_rewrite->set_permalink_structure( '/%postname%/' );

// What WordPress does with a request: match it against the rules and collect the query variables.
function guide_resolve( $path ) {
	global $wp;
	$_SERVER['REQUEST_URI'] = $path;
	$wp->parse_request();
	return $wp->query_vars;
}

function my_plugin_add_rewrite_rules() {
	add_rewrite_rule( '^books/([^/]+)/?$', 'index.php?my_plugin_book=$matches[1]', 'top' );
}
add_action( 'init', 'my_plugin_add_rewrite_rules' );

function my_plugin_activate() {
	my_plugin_add_rewrite_rules(); // init has already run during activation, so add the rule first.
	flush_rewrite_rules();
}
register_activation_hook( WP_PLUGIN_DIR . '/my-plugin/my-plugin.php', 'my_plugin_activate' );

function my_plugin_deactivate() {
	remove_action( 'init', 'my_plugin_add_rewrite_rules' );
	$GLOBALS['wp_rewrite']->extra_rules_top = array(); // What a new request without the plugin would have.
	flush_rewrite_rules();
}
register_deactivation_hook( WP_PLUGIN_DIR . '/my-plugin/my-plugin.php', 'my_plugin_deactivate' );

function guide_stored_rule() {
	$rules = get_option( 'rewrite_rules' );
	return is_array( $rules ) && isset( $rules['^books/([^/]+)/?$'] ) ? $rules['^books/([^/]+)/?$'] : false;
}

flush_rewrite_rules( false );
$before = guide_stored_rule();
my_plugin_activate();
$active = guide_stored_rule();
my_plugin_deactivate();
return array( 'before activation' => $before, 'after activation' => $active, 'after deactivation' => guide_stored_rule() );
