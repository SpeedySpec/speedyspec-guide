<?php
// Sets the current site's last_updated to now and fires wpmu_blog_updated.
add_action( 'wpmu_blog_updated', fn( $id ) => print( "wpmu_blog_updated $id\n" ) );
wpmu_update_blogs_date();
return get_site()->last_updated !== '2026-03-01 09:00:00';
