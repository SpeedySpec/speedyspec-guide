<?php
// Puts the edit post link in the theme's post meta markup, with the title for screen readers; nothing when the user can't edit it. On edit_post_link.
guide_theme( 'twentytwenty' );
$post = wp_insert_post( array( 'post_title' => 'Hello', 'post_content' => 'Body', 'post_status' => 'publish', 'post_date' => '2026-03-01 09:00:00' ) );
$html = twentytwenty_edit_post_link( '<a>Edit</a>', $post, 'Edit' );
wp_set_current_user( 0 );
return array( str_contains( $html, 'post-meta-edit-link-wrapper' ), str_contains( $html, 'Edit <span class="screen-reader-text">Hello</span>' ), twentytwenty_edit_post_link( '<a>Edit</a>', $post, 'Edit' ) );
