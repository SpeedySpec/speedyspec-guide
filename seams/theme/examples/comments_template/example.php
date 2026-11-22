<?php
// Loads the comments template on singular views (the theme's comments.php, else the compatibility one), with the post's comments queried and threaded; filtered by comments_template_query_args and comments_template.
$id = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );
$c = wp_insert_comment( array( 'comment_post_ID' => $id, 'comment_content' => 'Nice post', 'comment_author' => 'Ada', 'comment_author_email' => 'ada@example.org', 'comment_author_url' => 'https://ada.example', 'comment_author_IP' => '10.0.0.1', 'comment_date' => '2026-03-15 10:05:00', 'comment_date_gmt' => '2026-03-15 10:05:00', 'comment_approved' => 1 ) );
$GLOBALS['comment'] = get_comment( $c );
guide_go( "/?p=$id" );
the_post();
$html = guide_render( 'comments_template' );
return array( str_contains( $html, 'Nice post' ), $GLOBALS['wp_query']->comment_count );
