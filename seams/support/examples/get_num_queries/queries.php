<?php
// How many database queries the request has run.
$before = get_num_queries();
get_option( 'guide_uncached_' . 1 );
return get_num_queries() > $before;
