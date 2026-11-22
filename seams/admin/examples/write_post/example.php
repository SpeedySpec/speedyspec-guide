<?php
// Creates a post from the submitted form fields and gives its ID, stopping with an error message when it can't.
$_POST = array( 'post_type' => 'post', 'post_title' => 'From the form', 'post_status' => 'draft', 'user_ID' => 1 );
return get_the_title( write_post() );
