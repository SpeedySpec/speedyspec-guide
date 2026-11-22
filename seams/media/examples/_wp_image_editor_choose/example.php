<?php
// The first image editor class from wp_image_editors that passes the test for a file, MIME type and methods, or false.
add_filter( 'wp_image_editors', 'guide_gd_only' );
function guide_gd_only(): array
{
	return array( 'WP_Image_Editor_GD' );
}
return array( _wp_image_editor_choose( array( 'mime_type' => 'image/png' ) ), _wp_image_editor_choose( array( 'mime_type' => 'image/x-nonesuch' ) ) );
