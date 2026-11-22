<?php
// Shows a dismissed core update again.
guide_offer_core_update( '7.3' );
dismiss_core_update( find_core_update( '7.3', 'en_US' ) );
undismiss_core_update( '7.3', 'en_US' );
return array( get_site_option( 'dismissed_update_core' ), count( get_core_updates() ) );
