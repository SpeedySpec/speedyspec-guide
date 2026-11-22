<?php
// Whether the main query is for a post type's archive, optionally of given types.
register_post_type( 'book', array( 'public' => true, 'has_archive' => true ) );
guide_go( '/?post_type=book' );
return array( is_post_type_archive(), is_post_type_archive( 'book' ), is_post_type_archive( 'movie' ) );
