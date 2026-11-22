<?php
// A post's date from its local and GMT dates (either may be empty), validated; false for an invalid date.
return array( wp_resolve_post_date( '2026-03-01 10:00:00' ), wp_resolve_post_date( '', '2026-03-01 08:00:00' ), wp_resolve_post_date( '2026-02-30 10:00:00' ) );
