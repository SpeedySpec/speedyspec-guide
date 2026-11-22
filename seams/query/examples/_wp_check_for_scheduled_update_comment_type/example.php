<?php
// Schedules the comment type update when it hasn't finished and isn't scheduled.
update_option( 'finished_updating_comment_type', 0 );
_wp_check_for_scheduled_update_comment_type();
return (bool) wp_next_scheduled( 'wp_update_comment_type_batch' );
