<?php
// An expired transient is deleted when read, and reads as false. (This moves the timeout into the past.)
set_transient( 'guide_t', 'v', 60 );
update_option( '_transient_timeout_guide_t', time() - 1 );
return array( get_transient( 'guide_t' ), get_option( '_transient_guide_t' ) );
