<?php
// Prints the Underscore templates the file editor shows its notices with.
$html = guide_render( 'wp_print_file_editor_templates' );
return array( str_contains( $html, 'tmpl-wp-file-editor-notice' ), str_contains( $html, 'notice' ) );
