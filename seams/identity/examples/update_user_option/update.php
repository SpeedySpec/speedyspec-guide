<?php
// Saves a user setting for this site ({prefix}{name}) or, with $is_global, for all sites.
return array( is_int( update_user_option( 1, 'theme', 'dark' ) ), get_user_meta( 1, 'guide_theme', true ), is_int( update_user_option( 1, 'everywhere', 'yes', true ) ), get_user_meta( 1, 'everywhere', true ) );
