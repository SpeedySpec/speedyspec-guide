<?php
// On user_has_cap: grants view_site_health_checks to users who can install plugins (on a network, to super admins).
return array( wp_maybe_grant_site_health_caps( array( 'install_plugins' => true ), array(), array(), get_userdata( 1 ) ), wp_maybe_grant_site_health_caps( array(), array(), array(), get_userdata( 1 ) ) );
