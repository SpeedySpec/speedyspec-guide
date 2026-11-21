<?php
// register_setting and unregister_setting fire with the group and the name.
add_action( 'register_setting', function ( $group, $name ) { echo "register_setting $group $name "; }, 10, 2 );
add_action( 'unregister_setting', function ( $group, $name ) { echo "unregister_setting $group $name "; }, 10, 2 );
register_setting( 'guide', 'guide_color' );
unregister_setting( 'guide', 'guide_color' );
