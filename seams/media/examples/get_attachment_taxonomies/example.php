<?php
// The taxonomies registered for an attachment, for its post type and its MIME types.
register_taxonomy( 'image_tag', 'attachment:image' );
$id = guide_attachment();
return get_attachment_taxonomies( $id );
