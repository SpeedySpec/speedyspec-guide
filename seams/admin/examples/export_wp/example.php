<?php
// Prints the WordPress eXtended RSS export of the site's content (all, or posts of a type, author, date or status), with its authors, terms and comments, and sends the download headers.
wp_insert_post( array( 'post_title' => 'Tea notes', 'post_status' => 'publish' ) );
$xml = guide_render( fn() => export_wp( array( 'content' => 'post' ) ) );
return array( str_contains( $xml, '<wp:wxr_version>1.2</wp:wxr_version>' ), str_contains( $xml, 'Tea notes' ) );
