<?php
// The archive's description: the term's, the author's bio, or the post type's; filtered by get_the_archive_description.
wp_update_term( 1, 'category', array( 'description' => 'Everything else.' ) );
guide_go( '/?cat=1' );
return get_the_archive_description();
