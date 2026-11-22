<?php
// Deletes an import file's attachment once the import is done.
$id = wp_insert_attachment( array( 'post_title' => 'export.xml', 'post_mime_type' => 'text/xml', 'post_status' => 'private' ), 'export.xml' );
wp_import_cleanup( $id );
return get_post( $id );
