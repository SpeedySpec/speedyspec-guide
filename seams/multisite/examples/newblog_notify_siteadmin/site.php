<?php
// Emails the network admin about a new site, when registration notifications are on; the message is filtered. WordPress sends it when the site or user is made, so here it goes twice.
update_site_option( 'registrationnotification', 'yes' );
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
return newblog_notify_siteadmin( $site );
