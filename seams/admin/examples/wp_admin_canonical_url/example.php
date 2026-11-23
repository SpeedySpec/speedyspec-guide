<?php
// Prints the canonical link and the script that drops one-time query arguments, such as message or updated, from the admin page's address.
$_SERVER['REQUEST_URI'] = '/wp-admin/edit.php?updated=1&post_type=page';
$html = guide_render( 'wp_admin_canonical_url' );
return array( str_contains( $html, 'rel="canonical"' ), str_contains( $html, 'post_type=page' ), str_contains( $html, 'updated=1' ) );
