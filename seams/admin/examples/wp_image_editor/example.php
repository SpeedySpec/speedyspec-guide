<?php
// Prints the image editor of an attachment: the preview, the crop, rotate, flip and scale tools, and the thumbnail settings.
$id = guide_image_attachment( 'guide-editor-ui', 40, 30 );
$html = guide_render( fn() => wp_image_editor( $id ) );
wp_delete_attachment( $id, true );
return array( str_contains( $html, 'imgedit-panel' ), str_contains( $html, 'imgedit-scale' ) );
