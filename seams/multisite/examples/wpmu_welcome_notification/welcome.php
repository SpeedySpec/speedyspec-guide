<?php
// Emails a new site's admin the welcome text with their login details, unless wpmu_welcome_notification says no.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
return wpmu_welcome_notification( $site, 1, 'secret', 'Second' );
