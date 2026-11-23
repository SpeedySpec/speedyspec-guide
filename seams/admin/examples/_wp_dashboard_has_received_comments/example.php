<?php
// Whether the site has any comments that aren't spam or trash, so the Activity widget knows to show them.
$before = _wp_dashboard_has_received_comments();
$post = wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'publish' ) );
wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => 'Lovely', 'comment_approved' => 1 ) );
return array( $before, _wp_dashboard_has_received_comments() );
