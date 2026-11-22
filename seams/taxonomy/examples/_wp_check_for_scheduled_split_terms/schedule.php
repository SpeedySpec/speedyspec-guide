<?php
// Until shared terms are all split, makes sure the next batch is scheduled.
_wp_check_for_scheduled_split_terms();
return (bool) wp_next_scheduled( 'wp_split_shared_term_batch' );
