<?php
// A module wp-editor already depends on isn't added twice.
$scripts = new WP_Scripts();
$scripts->add( 'wp-editor', '/editor.js' );
$scripts->enqueue( 'wp-editor' );
$scripts->add_data( 'wp-editor', 'module_dependencies', array( '@my-plugin/m' ) );
_wp_add_entity_modules_to_editor_script( $scripts, fn() => array( 'postType' => array( 'book' => array( '@my-plugin/m', '@my-plugin/n' ) ) ) );
return $scripts->get_data( 'wp-editor', 'module_dependencies' );
