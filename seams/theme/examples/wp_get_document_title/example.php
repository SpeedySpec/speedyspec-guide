<?php
// The document title for the page: its title and the site name joined by a separator (the tagline on the home page, page numbers when paged); filtered by pre_get_document_title, document_title_separator, document_title_parts and document_title.
$id = wp_insert_post( array( 'post_title' => 'Hello World', 'post_status' => 'publish', 'post_date' => '2026-03-15 10:05:06', 'post_modified' => '2026-04-01 08:00:00' ) );
guide_go( "/?p=$id" );
the_post();
$single = wp_get_document_title();
guide_go( '/' );
return array( $single, wp_get_document_title() );
