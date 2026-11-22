<?php
// Registers a sidebar with defaults for its markup, turns on the widgets theme support, and fires register_sidebar; an empty id is a mistake reported with _doing_it_wrong, given sidebar-N. register_sidebar_defaults filters the defaults.
add_action( 'doing_it_wrong_run', fn( $f ) => print( "doing_it_wrong_run $f\n" ) );
add_filter( 'doing_it_wrong_trigger_error', '__return_false' );
add_action( 'register_sidebar', fn( $s ) => print( "register_sidebar {$s['id']}\n" ) );
$id = register_sidebar( array( 'id' => 'side', 'name' => 'Side', 'before_widget' => '<section id="%1$s" class="%2$s">' ) );
$auto = register_sidebar();
return array( $id, $auto, $GLOBALS['wp_registered_sidebars']['side']['before_title'], current_theme_supports( 'widgets' ) );
