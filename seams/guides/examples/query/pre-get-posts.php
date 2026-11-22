<?php
// Change the main query before it runs with pre_get_posts, checking that it is the main query of a front-end page.
function my_plugin_three_posts_on_home( WP_Query $query ) {
	if ( is_admin() || ! $query->is_main_query() || ! $query->is_home() ) {
		return;
	}
	$query->set( 'posts_per_page', 3 );
}
add_action( 'pre_get_posts', 'my_plugin_three_posts_on_home' );

foreach ( array( 'One', 'Two', 'Three', 'Four', 'Five' ) as $title ) {
	wp_insert_post( array( 'post_title' => $title, 'post_status' => 'publish' ) );
}

// WordPress builds the main query from the request; here, the home page.
$_SERVER['REQUEST_URI'] = '/';
$GLOBALS['wp']->main();
$other = new WP_Query( array( 'post_type' => 'post' ) ); // A secondary query: the callback leaves it alone.
return array(
	'main query, home'  => count( $GLOBALS['wp_query']->posts ),
	'found in all'      => $GLOBALS['wp_query']->found_posts,
	'a secondary query' => count( $other->posts ),
);
