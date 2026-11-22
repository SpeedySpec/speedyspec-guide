<?php
// Prints the authors of the exported posts as wp:author elements; defined by export_wp().
guide_render( 'export_wp' );
$post = wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'publish' ) );
return str_contains( guide_render( fn() => wxr_authors_list( array( $post ) ) ), '<wp:author_login><![CDATA[admin]]></wp:author_login>' );
