<?php
// default_option_{$option} supplies the value of an option that isn't stored.
add_filter( 'default_option_guide_size', fn() => 'medium' );
return get_option( 'guide_size' );
