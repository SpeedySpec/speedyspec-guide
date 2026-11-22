<?php
// register_setting and unregister_setting fire with the group and the name.
function guide_announce_register_setting( $group, $name ) {
	echo "register_setting $group $name ";
}
add_action( 'register_setting', 'guide_announce_register_setting', 10, 2 );
function guide_announce_unregister_setting( $group, $name ) {
	echo "unregister_setting $group $name ";
}
add_action( 'unregister_setting', 'guide_announce_unregister_setting', 10, 2 );
register_setting( 'guide', 'guide_color' );
unregister_setting( 'guide', 'guide_color' );
