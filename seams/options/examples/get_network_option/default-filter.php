<?php
// default_site_option_{$option} supplies the value of a network option that isn't stored.
add_filter( 'default_site_option_guide_size', fn() => 'medium' );
return get_network_option( 1, 'guide_size' );
