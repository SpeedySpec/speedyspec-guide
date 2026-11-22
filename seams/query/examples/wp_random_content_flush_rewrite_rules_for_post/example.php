<?php
// Hooked to wp_after_insert_post and after_delete_post: flushes the rewrite rules when a published page (or a post, when posts share the URL) at the random base changes, since it takes precedence over random redirects.
update_option( 'permalink_structure', '/%postname%/' );
$GLOBALS['wp_rewrite']->init();
add_action( 'generate_rewrite_rules', 'guide_count_flush' );
function guide_count_flush() {
	$GLOBALS['guide_flushes'] = ( $GLOBALS['guide_flushes'] ?? 0 ) + 1;
}
wp_insert_post( array( 'post_title' => 'Random', 'post_name' => 'random', 'post_type' => 'page', 'post_status' => 'publish' ) );
$page = $GLOBALS['guide_flushes'] ?? 0;
wp_insert_post( array( 'post_title' => 'Elsewhere', 'post_type' => 'page', 'post_status' => 'publish' ) );
return array( $page > 0, ( $GLOBALS['guide_flushes'] ?? 0 ) === $page );
