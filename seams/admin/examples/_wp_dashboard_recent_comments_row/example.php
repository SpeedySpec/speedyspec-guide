<?php
// Prints one comment of the Activity widget, with its author, post and moderation actions.
$post = wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'publish' ) );
$comment = get_comment( wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => 'Lovely brew', 'comment_approved' => 1, 'comment_author' => 'Ada' ) ) );
$html = guide_render( fn() => _wp_dashboard_recent_comments_row( $comment ) );
return array( str_contains( $html, 'Lovely brew' ), str_contains( $html, 'row-actions' ) );
