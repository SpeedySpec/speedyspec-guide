<?php
// The path of an attachment's image file, or a size of it, to edit; a URL when the file isn't local and fopen allows URLs.
$id = guide_image_attachment( 'guide-path', 40, 30 );
$path = _load_image_to_edit_path( $id );
$result = $path === get_attached_file( $id );
wp_delete_attachment( $id, true );
return $result;
