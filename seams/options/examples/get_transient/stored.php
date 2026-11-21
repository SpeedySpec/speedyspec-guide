<?php
// Reads a transient back; a missing one is false.
set_transient( 'guide_t', 'v' );
return array( get_transient( 'guide_t' ), get_transient( 'guide_missing' ) );
