<?php
// Renders the Cover block (core/cover) on the server, from its attributes, inner content and context: add an image or video with a text overlay.
$id = wp_insert_post( array( 'post_title' => 'Hello World', 'post_status' => 'publish', 'post_date' => '2026-03-15 10:00:00', 'post_content' => '<!-- wp:paragraph --><p>Some words here.</p><!-- /wp:paragraph -->', 'post_excerpt' => 'A short summary.', 'tags_input' => array( 'red' ) ) );
wp_insert_comment( array( 'comment_post_ID' => $id, 'comment_content' => 'Nice post', 'comment_author' => 'Ada', 'comment_approved' => 1, 'comment_date' => '2026-03-16 09:00:00', 'comment_date_gmt' => '2026-03-16 09:00:00' ) );
guide_go( "/?p=$id" );
the_post();
$block = new WP_Block( parse_blocks( '<!-- wp:cover {"url":"http://example.org/bg.jpg","dimRatio":50} --><div class="wp-block-cover"><span class="wp-block-cover__background has-background-dim"></span><img class="wp-block-cover__image-background" src="http://example.org/bg.jpg"/><div class="wp-block-cover__inner-container"><!-- wp:paragraph --><p>Over</p><!-- /wp:paragraph --></div></div><!-- /wp:cover -->' )[0], array( 'postId' => $id, 'postType' => 'post', 'queryId' => 0, 'query' => array( 'perPage' => 2 ), 'commentId' => 1 ) );
$html = $block->render();
return array( str_contains( $html, 'wp-block-cover' ), mb_substr( trim( preg_replace( '/\s+/', ' ', wp_strip_all_tags( $html ) ) ), 0, 80 ) );
