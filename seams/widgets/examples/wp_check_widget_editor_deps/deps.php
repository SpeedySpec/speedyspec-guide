<?php
// With the block widgets editor enqueued, reports the classic editor script or the post editor style enqueued with it as a mistake.
function guide_print_doing_it_wrong( $function_name ) {
	echo "doing_it_wrong_run $function_name\n";
}
add_action( 'doing_it_wrong_run', 'guide_print_doing_it_wrong' );
add_filter( 'doing_it_wrong_trigger_error', '__return_false' );
function guide_enqueue_widget_editor_with_classic_editor() {
	wp_register_script( 'wp-edit-widgets', false );
	wp_register_script( 'wp-editor', false );
	wp_enqueue_script( 'wp-edit-widgets' );
	wp_enqueue_script( 'wp-editor' );
	wp_styles();
	wp_check_widget_editor_deps();
}
add_action( 'wp_enqueue_scripts', 'guide_enqueue_widget_editor_with_classic_editor' );
do_action( 'wp_enqueue_scripts' );
return null;
