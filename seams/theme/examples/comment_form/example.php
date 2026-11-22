<?php
// Prints the comment form: its fields (author, email, url, cookies consent), textarea, notes and submit button, or a log in prompt, with comment_form_before/after and many filters.
$id = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );
wp_set_current_user( 0 );
guide_go( "/?p=$id" );
the_post();
$html = guide_render( fn() => comment_form( array( 'title_reply' => 'Say hi' ) ) );
return array( str_contains( $html, 'Say hi' ), str_contains( $html, 'name="author"' ), str_contains( $html, 'wp-comment-cookies-consent' ), str_contains( $html, 'comment_post_ID' ) );
