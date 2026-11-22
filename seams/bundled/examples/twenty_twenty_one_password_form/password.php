<?php
// The theme's password form for protected posts: a message, then the label, field and Enter button; on the_password_form.
guide_theme( 'twentytwentyone' );
$post = wp_insert_post( array( 'post_title' => 'Hello', 'post_content' => 'Body', 'post_status' => 'publish', 'post_date' => '2026-03-01 09:00:00' ) );
return str_contains( twenty_twenty_one_password_form( '', $post ), 'This content is password protected' ) && str_contains( twenty_twenty_one_password_form( '', $post ), 'for="pwbox-' . $post . '"' );
