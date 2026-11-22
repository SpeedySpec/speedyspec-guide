<?php
// With the block widgets editor enqueued, reports the classic editor script or the post editor style enqueued with it as a mistake.
add_action( 'doing_it_wrong_run', fn( $f ) => print( "doing_it_wrong_run $f\n" ) );
add_filter( 'doing_it_wrong_trigger_error', '__return_false' );
add_action( 'wp_enqueue_scripts', function () {
    wp_register_script( 'wp-edit-widgets', false );
    wp_register_script( 'wp-editor', false );
    wp_enqueue_script( 'wp-edit-widgets' );
    wp_enqueue_script( 'wp-editor' );
    wp_styles();
    wp_check_widget_editor_deps();
} );
do_action( 'wp_enqueue_scripts' );
return null;
