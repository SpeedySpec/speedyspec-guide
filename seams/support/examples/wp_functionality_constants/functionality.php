<?php
// Defines the autosave interval (60 seconds), the trash days (30), the revisions setting (on) and the cron lock timeout (a minute), unless already defined.
wp_functionality_constants();
return array( AUTOSAVE_INTERVAL, EMPTY_TRASH_DAYS, WP_POST_REVISIONS, WP_CRON_LOCK_TIMEOUT );
