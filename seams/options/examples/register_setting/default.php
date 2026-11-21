<?php
// A registered default is what get_option() returns while the option isn't stored.
register_setting( 'guide', 'guide_color', array( 'default' => 'blue' ) );
return array( get_option( 'guide_color' ), get_option( 'guide_color', 'red' ) );
