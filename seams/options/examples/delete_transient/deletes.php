<?php
// Deletes the transient and its timeout, and returns true.
set_transient( 'guide_t', 'v', 60 );
return array( delete_transient( 'guide_t' ), get_option( '_transient_timeout_guide_t' ) );
