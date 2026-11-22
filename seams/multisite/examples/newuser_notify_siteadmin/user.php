<?php
// Emails the network admin about a new user, when registration notifications are on; the message is filtered. WordPress sends it when the site or user is made, so here it goes twice.
update_site_option( 'registrationnotification', 'yes' );
$grace = wpmu_create_user( 'grace', 'secret', 'grace@example.org' );
return newuser_notify_siteadmin( $grace );
