<?php
// The title of the post type archive queried; filtered by post_type_archive_title.
register_post_type( 'book', array( 'public' => true, 'has_archive' => true, 'label' => 'Books' ) );
guide_go( '/?post_type=book' );
return post_type_archive_title( '', false );
