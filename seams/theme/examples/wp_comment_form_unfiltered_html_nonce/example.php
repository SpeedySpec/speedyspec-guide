<?php
// Prints the nonce letting users with unfiltered_html post unfiltered comments, on the comment form.
$id = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );
guide_go( "/?p=$id" );
the_post();
return str_contains( guide_render( 'wp_comment_form_unfiltered_html_nonce' ), '_wp_unfiltered_html_comment_disabled' );
