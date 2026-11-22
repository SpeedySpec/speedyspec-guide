<?php
// In the site editor, preloads the actions route for the post types of the screen in ?p=.
// (No database here: sanitize_text_field() reads blog_charset, which a filter supplies.)
function guide_blog_charset( $charset ) {
	return 'UTF-8';
}
add_filter( 'pre_option_blog_charset', 'guide_blog_charset' );
foreach ( array( 'page', 'wp_block', 'wp_template_part' ) as $type ) {
	$GLOBALS['wp_post_types'][ $type ] = (object) array( 'name' => $type );
}
$_GET['p'] = '/pattern';
$context = new WP_Block_Editor_Context( array( 'name' => 'core/edit-site' ) );
return _wp_preload_entity_actions( array( '/wp/v2/types' ), $context );
