<?php
// Returns, per option, whether its autoload value changed.
add_option( 'guide_a', '1', '', true );
add_option( 'guide_b', '1', '', true );
return wp_set_option_autoload_values( array( 'guide_a' => false, 'guide_b' => true ) );
