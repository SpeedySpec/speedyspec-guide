<?php
// Prints a post's footer: author, date, categories and tags with icons, the comments link in lists, and the edit link.
guide_theme( 'twentynineteen' );
$post = wp_insert_post( array( 'post_title' => 'Hello', 'post_content' => 'Body', 'post_status' => 'publish', 'post_date' => '2026-03-01 09:00:00' ) );
$GLOBALS['wp_query'] = new WP_Query( array( 'p' => $post ) );
$GLOBALS['wp_the_query'] = $GLOBALS['wp_query'];
the_post();
wp_set_current_user( 0 );
return trim( preg_replace( '/\s+/', ' ', wp_strip_all_tags( guide_render( 'twentynineteen_entry_footer' ) ) ) );
