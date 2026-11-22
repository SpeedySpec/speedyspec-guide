<?php
// The offered core update of a version and locale, or false.
guide_offer_core_update( '7.3' );
return array( find_core_update( '7.3', 'en_US' )->response, find_core_update( '9.9', 'en_US' ) );
