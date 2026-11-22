<?php
// Prints a post's footer meta: in lists, Featured for sticky posts, the date, the edit link and the categories and tags; on single posts, the date, author and edit link, then the categories and tags. Nothing for other post types.
guide_theme( 'twentytwentyone' );
$post = wp_insert_post( array( 'post_title' => 'Hello', 'post_content' => 'Body', 'post_status' => 'publish', 'post_date' => '2026-03-01 09:00:00' ) );
$GLOBALS['wp_query'] = new WP_Query( array( 'p' => $post ) );
$GLOBALS['wp_the_query'] = $GLOBALS['wp_query'];
the_post();
wp_set_current_user( 0 );
$html = guide_render( 'twenty_twenty_one_entry_meta_footer' );
return preg_replace( '/href="[^"]*"/', 'href', $html );
