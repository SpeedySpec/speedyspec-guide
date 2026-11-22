<?php
// A new post with default values for the editor, saved as an auto-draft when asked.
$post = get_default_post_to_edit( 'page', true );
return array( $post->post_type, $post->post_status, $post->ID > 0 );
