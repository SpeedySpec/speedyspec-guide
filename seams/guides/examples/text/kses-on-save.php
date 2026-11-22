<?php
// Post content is filtered through kses when saved by someone without unfiltered_html; administrators keep everything.
$html = '<p onclick="steal()">Hello <strong>there</strong></p><script>steal()</script>';

$author = wp_insert_user( array( 'user_login' => 'aria', 'user_pass' => wp_generate_password(), 'role' => 'author' ) );
wp_set_current_user( $author ); // Switching user re-applies the kses filters for them.
$by_author = wp_insert_post( array( 'post_title' => 'By an author', 'post_content' => $html, 'post_status' => 'draft' ) );

wp_set_current_user( 1 );
$by_admin = wp_insert_post( array( 'post_title' => 'By an administrator', 'post_content' => $html, 'post_status' => 'draft' ) );

return array(
	'author has unfiltered_html' => user_can( $author, 'unfiltered_html' ),
	'saved by the author'        => get_post_field( 'post_content', $by_author, 'raw' ),
	'saved by the administrator' => get_post_field( 'post_content', $by_admin, 'raw' ),
);
