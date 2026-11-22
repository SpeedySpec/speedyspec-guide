<?php
// Whether the request is for a site's own admin: the current screen, else WP_BLOG_ADMIN.
set_current_screen( 'dashboard' );
$site = is_blog_admin();
return array( $site, is_network_admin(), is_user_admin() );
