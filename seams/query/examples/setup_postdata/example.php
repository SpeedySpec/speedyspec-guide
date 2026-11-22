<?php
// Sets up the template globals ($id, $authordata, $pages, $page and the rest) for a post, as the Loop does; through the main query's setup_postdata().
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );

setup_postdata( get_post( $id ) );
return array( $GLOBALS['id'] === $id, $GLOBALS['authordata']->user_login, $GLOBALS['pages'] );
