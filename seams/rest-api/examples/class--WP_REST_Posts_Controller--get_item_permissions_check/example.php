<?php
// Reading a post needs it to be readable: published and public, or the user able to read it; drafts are hidden from visitors, and password-protected content needs the password.
$draft = wp_insert_post( array( 'post_title' => 'Secret draft' ) );
$locked = wp_insert_post( array( 'post_title' => 'Locked', 'post_status' => 'publish', 'post_password' => 'pw', 'post_content' => 'Hidden text' ) );
wp_set_current_user( 0 );
return array( guide_rest( 'GET', "/wp/v2/posts/$draft" )[0], guide_rest( 'GET', "/wp/v2/posts/$locked" )[1]['content'], guide_rest( 'GET', "/wp/v2/posts/$locked", array( 'password' => 'pw' ) )[1]['content']['rendered'] );
