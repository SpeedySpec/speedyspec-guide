<?php
// Hooked to edit_form_after_editor: gives wp_navigation back its editor support after the classic edit form.
$nav = get_post( wp_insert_post( array( 'post_type' => 'wp_navigation', 'post_title' => 'Header', 'post_status' => 'publish' ) ) );
_disable_content_editor_for_navigation_post_type( $nav );
_enable_content_editor_for_navigation_post_type( $nav );
return post_type_supports( 'wp_navigation', 'editor' );
