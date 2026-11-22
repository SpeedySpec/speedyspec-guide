<?php
// Loads the old Requests library's classes before a core update replaces its files, so the update can finish.
WP_Filesystem();
_preload_old_requests_classes_and_interfaces( ABSPATH );
return defined( 'REQUESTS_SILENCE_PSR0_DEPRECATIONS' );
