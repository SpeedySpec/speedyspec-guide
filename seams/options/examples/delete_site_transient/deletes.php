<?php
// Deletes the site transient and its timeout, and returns true.
set_site_transient( 'guide_t', 'v', 60 );
return array( delete_site_transient( 'guide_t' ), get_site_option( '_site_transient_timeout_guide_t' ) );
