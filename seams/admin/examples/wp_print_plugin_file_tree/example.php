<?php
// Prints a plugin's file tree as nested lists in the file editor, marking the file being edited.
$GLOBALS['file'] = 'tea/tea.php';
$GLOBALS['plugin'] = 'tea/tea.php';
$html = guide_render( fn() => wp_print_plugin_file_tree( wp_make_plugin_file_tree( array( 'tea/tea.php', 'tea/includes/blend.php' ) ) ) );
return array( str_contains( $html, 'includes' ), str_contains( $html, 'blend.php' ) );
