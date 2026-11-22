<?php
// Prints the comment form without a title when the order given matches the site's comment order (or is true), so it appears above or below the comments.
guide_theme( 'twentynineteen' );
$post = wp_insert_post( array( 'post_title' => 'Hello', 'post_content' => 'Body', 'post_status' => 'publish', 'post_date' => '2026-03-01 09:00:00' ) );
$GLOBALS['wp_query'] = new WP_Query( array( 'p' => $post ) );
$GLOBALS['wp_the_query'] = $GLOBALS['wp_query'];
the_post();
return array( str_contains( guide_render( fn() => twentynineteen_comment_form( 'asc' ) ), 'id="commentform"' ), guide_render( fn() => twentynineteen_comment_form( 'desc' ) ) );
