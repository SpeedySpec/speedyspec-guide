<?php
// Emails the network admin that a site was created, unless send_new_site_email says no.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
return wpmu_new_site_admin_notification( $site, 1 );
