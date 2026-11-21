<?php
// Reads a site transient back; a missing one is false.
set_site_transient( 'guide_t', 'v' );
return array( get_site_transient( 'guide_t' ), get_site_transient( 'guide_missing' ) );
