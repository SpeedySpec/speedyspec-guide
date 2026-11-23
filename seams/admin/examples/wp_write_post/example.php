<?php
// Creates a post from the submitted form fields; gives its ID or an error.
$_POST = array( 'post_type' => 'post', 'post_title' => 'From the form', 'post_status' => 'draft', 'user_ID' => 1, 'temp_ID' => 0 );
$id = wp_write_post();
return get_the_title( $id );
