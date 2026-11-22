<?php
// Registers a sidebar with defaults for its markup, turns on the widgets theme support, and fires register_sidebar; an empty id is a mistake reported with _doing_it_wrong, given sidebar-N. register_sidebar_defaults filters the defaults.
function guide_print_doing_it_wrong( $function_name ) {
	echo "doing_it_wrong_run $function_name\n";
}
add_action( 'doing_it_wrong_run', 'guide_print_doing_it_wrong' );
add_filter( 'doing_it_wrong_trigger_error', '__return_false' );
function guide_print_register_sidebar( $sidebar ) {
	echo "register_sidebar {$sidebar['id']}\n";
}
add_action( 'register_sidebar', 'guide_print_register_sidebar' );
$id = register_sidebar( array( 'id' => 'side', 'name' => 'Side', 'before_widget' => '<section id="%1$s" class="%2$s">' ) );
$auto = register_sidebar();
return array( $id, $auto, $GLOBALS['wp_registered_sidebars']['side']['before_title'], current_theme_supports( 'widgets' ) );
