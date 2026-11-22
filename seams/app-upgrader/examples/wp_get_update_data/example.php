<?php
// The counts of pending core, plugin, theme and translation updates the current user can apply, with the title the admin menu shows.
guide_offer_core_update( '7.3' );
set_site_transient( 'update_plugins', (object) array( 'response' => array( 'hello.php' => (object) array( 'slug' => 'hello-dolly', 'new_version' => '1.8' ) ) ) );
return wp_get_update_data();
