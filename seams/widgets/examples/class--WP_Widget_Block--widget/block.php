<?php
// The Block widget: rendered block content, with the block's class names on the wrapper.
$cat = wp_insert_term( 'News', 'category' )['term_id'];
$post = wp_insert_post( array( 'post_title' => 'First post', 'post_status' => 'publish', 'post_date' => '2026-03-05 10:00:00', 'post_category' => array( $cat ), 'tags_input' => array( 'alpha', 'beta' ) ) );
wp_insert_post( array( 'post_title' => 'About', 'post_type' => 'page', 'post_status' => 'publish' ) );
wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_author' => 'Ada', 'comment_content' => 'Nice', 'comment_approved' => 1 ) );
$args = array( 'before_widget' => '<section class="%s">', 'after_widget' => '</section>', 'before_title' => '<h2>', 'after_title' => '</h2>' );
return guide_render( fn() => the_widget( 'WP_Widget_Block', array( 'content' => '<p>Block text</p>' ), $args ) );
