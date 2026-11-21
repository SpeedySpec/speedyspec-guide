<?php
// Sets one autoload value for several options.
add_option( 'guide_a', '1', '', true );
add_option( 'guide_b', '1', '', true );
return wp_set_options_autoload( array( 'guide_a', 'guide_b' ), false );
