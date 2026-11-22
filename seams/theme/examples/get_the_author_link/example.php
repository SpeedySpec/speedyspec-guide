<?php
// The post author's name linked to their website, or just the name.
wp_update_user( array( 'ID' => 1, 'user_url' => 'https://admin.example' ) );
$id = wp_insert_post( array( 'post_title' => 'By admin', 'post_status' => 'publish', 'post_author' => 1 ) );
guide_go( "/?p=$id" );
the_post();
return get_the_author_link();
