<?php
// callback, RenderModal and isEligible belong in the script module: they are dropped and reported.
add_action( 'doing_it_wrong_run', function ( $function_name ) { echo "$function_name "; } );
add_action( 'wp_entity_actions_api_init', function () {
	wp_register_entity_actions( 'my-plugin', 'postType', 'book', array( array( 'id' => 'archive', 'callback' => 'x' ) ) );
} );
do_action( 'init' );
return array_key_exists( 'callback', wp_get_registered_entity_actions( 'postType', 'book' )[0] );
