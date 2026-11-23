<?php
// Deletes a site of a network, or only marks it deleted unless asked to drop its tables, firing the hooks around it.
$site = wpmu_create_blog( 'example.org', '/tea/', 'Tea', 1 );
wpmu_delete_blog( $site, true );
return get_site( $site );
