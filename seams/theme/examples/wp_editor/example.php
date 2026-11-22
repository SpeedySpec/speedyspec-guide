<?php
// Prints the classic editor (TinyMCE and Quicktags) for a field, with its settings, through _WP_Editors.
$html = guide_render( fn() => wp_editor( 'Hello', 'guide_field', array( 'textarea_rows' => 4, 'media_buttons' => false ) ) );
return array( str_contains( $html, 'id="guide_field"' ), str_contains( $html, 'wp-editor-wrap' ) );
