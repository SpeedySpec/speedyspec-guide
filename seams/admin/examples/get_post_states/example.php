<?php
// The states shown after a post's title in admin lists: Draft, Pending, Private, Password protected, Sticky, Front Page and others; filtered by display_post_states.
$post = wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'draft', 'post_password' => 'secret' ) );
return get_post_states( get_post( $post ) );
