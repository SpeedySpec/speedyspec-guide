<?php
// The form asking for a protected post's password; filtered by the_password_form.
$id = wp_insert_post( array( 'post_title' => 'L', 'post_status' => 'publish', 'post_password' => 'pw' ) );
$form = get_the_password_form( $id );
return array( str_contains( $form, 'action=postpass' ), str_contains( $form, 'name="post_password"' ) );
