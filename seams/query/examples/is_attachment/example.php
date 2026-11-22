<?php
// Whether the main query is for an attachment page, optionally a given one.
$att = wp_insert_attachment( array( 'post_title' => 'Pic', 'post_mime_type' => 'image/png' ) );
guide_go( "/?attachment_id=$att" );
return array( is_attachment(), is_attachment( $att ), is_single() );
