<?php
// pre_wp_load_alloptions replaces the whole set.
add_filter( 'pre_wp_load_alloptions', fn() => array( 'guide' => 'yes' ) );
return wp_load_alloptions();
