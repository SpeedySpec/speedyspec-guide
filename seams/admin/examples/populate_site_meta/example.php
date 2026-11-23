<?php
// Adds the initial site meta of a new site in a network.
$site = wpmu_create_blog( 'example.org', '/tea/', 'Tea', 1 );
populate_site_meta( $site, array( 'guide_note' => 'hello' ) );
return get_site_meta( $site, 'guide_note', true );
