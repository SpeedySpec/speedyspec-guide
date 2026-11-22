<?php
// The description of the post type archive queried; filtered by get_the_post_type_description.
register_post_type( 'book', array( 'public' => true, 'has_archive' => true, 'description' => 'All our books.' ) );
guide_go( '/?post_type=book' );
return get_the_post_type_description();
