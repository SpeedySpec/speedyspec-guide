<?php
// An expired site transient is deleted when read. (This moves the timeout into the past.)
set_site_transient( 'guide_t', 'v', 60 );
update_site_option( '_site_transient_timeout_guide_t', time() - 1 );
return array( get_site_transient( 'guide_t' ), get_site_option( '_site_transient_guide_t' ) );
