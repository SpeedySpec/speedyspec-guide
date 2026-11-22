<?php
// Renders the Template Part block (core/template-part) on the server, from its attributes, inner content and context: edit the different global regions of your site, like the header, footer, sidebar, or create your own.
$id = wp_insert_post( array( 'post_title' => 'Hello World', 'post_status' => 'publish', 'post_date' => '2026-03-15 10:00:00', 'post_content' => '<!-- wp:paragraph --><p>Some words here.</p><!-- /wp:paragraph -->', 'post_excerpt' => 'A short summary.', 'tags_input' => array( 'red' ) ) );
wp_insert_comment( array( 'comment_post_ID' => $id, 'comment_content' => 'Nice post', 'comment_author' => 'Ada', 'comment_approved' => 1, 'comment_date' => '2026-03-16 09:00:00', 'comment_date_gmt' => '2026-03-16 09:00:00' ) );
guide_go( "/?p=$id" );
the_post();
$block = new WP_Block( parse_blocks( '<!-- wp:template-part /-->' )[0], array( 'postId' => $id, 'postType' => 'post', 'queryId' => 0, 'query' => array( 'perPage' => 2 ), 'commentId' => 1 ) );
$html = $block->render();
return array( str_contains( $html, 'wp-block-template-part' ), mb_substr( trim( preg_replace( '/\s+/', ' ', wp_strip_all_tags( $html ) ) ), 0, 80 ) );
