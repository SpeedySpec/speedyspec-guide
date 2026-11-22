<?php
// A post type's archive URL, false when it has none; filtered by post_type_archive_link.
register_post_type( 'book', array( 'public' => true, 'has_archive' => true ) );
register_post_type( 'note', array( 'public' => true ) );
return array( get_post_type_archive_link( 'book' ), get_post_type_archive_link( 'note' ), get_post_type_archive_link( 'post' ) );
