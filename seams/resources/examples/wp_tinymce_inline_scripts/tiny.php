<?php
// Adds the classic editor's TinyMCE settings and translations inline before wp-block-library, for the block editor's Classic block.
wp_scripts();
wp_tinymce_inline_scripts();
return str_contains( implode( '', (array) wp_scripts()->get_data( 'wp-block-library', 'before' ) ), 'wpEditorL10n' );
