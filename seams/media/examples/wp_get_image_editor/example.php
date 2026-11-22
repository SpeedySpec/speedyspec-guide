<?php
// The image editor (Imagick or GD) that can open a file and do what is asked, with the file loaded, or an error; the editors come from wp_image_editors.
$editor = wp_get_image_editor( guide_image( 40, 30, 'png' ) );
return array( get_class( $editor ), $editor->get_size() );
