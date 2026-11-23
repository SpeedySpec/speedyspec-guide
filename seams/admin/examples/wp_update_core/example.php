<?php
// Deprecated in 3.7.0; use new Core_Upgrader();. Started a core update, now with Core_Upgrader.
list( $result, $notice ) = guide_deprecated( 'wp_update_core', null );
return array( $result, strtok( $notice, '<' ) );
