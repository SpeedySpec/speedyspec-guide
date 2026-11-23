<?php
// Applies the image editor's pending changes (rotate, flip, crop) in order to an image editor object.
$id = guide_image_attachment( 'guide-apply', 40, 30 );
$editor = wp_get_image_editor( get_attached_file( $id ) );
$editor = image_edit_apply_changes( $editor, array( (object) array( 'r' => 90 ) ) );
$size = $editor->get_size();
wp_delete_attachment( $id, true );
return $size;
