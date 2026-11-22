<?php
// Hides an offered core update from the updates screen, by remembering its version and locale in dismissed_update_core.
guide_offer_core_update( '7.3' );
dismiss_core_update( find_core_update( '7.3', 'en_US' ) );
return array( get_site_option( 'dismissed_update_core' ), count( get_core_updates() ), count( get_core_updates( array( 'dismissed' => true ) ) ) );
