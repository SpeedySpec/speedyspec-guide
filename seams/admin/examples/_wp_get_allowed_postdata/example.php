<?php
// The submitted post fields allowed to reach wp_insert_post(): all but meta_input, file and guid, which a form mustn't set.
return array_keys( _wp_get_allowed_postdata( array( 'post_title' => 'Tea', 'post_content' => 'Hot', 'hidden_post_status' => 'draft', 'guid' => 'x', 'meta_input' => array() ) ) );
