<?php
// Prints a theme's file tree as nested lists in the file editor, marking the file being edited.
$GLOBALS['relative_file'] = 'style.css';
$GLOBALS['stylesheet'] = get_stylesheet();
$html = guide_render( fn() => wp_print_theme_file_tree( wp_make_theme_file_tree( array( 'style.css' => '/x/style.css', 'templates/index.html' => '/x/templates/index.html' ) ) ) );
return array( str_contains( $html, 'templates' ), str_contains( $html, 'style.css' ) );
