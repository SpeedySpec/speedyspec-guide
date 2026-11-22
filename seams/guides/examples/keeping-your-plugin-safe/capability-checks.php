<?php
// Check what the current person may do, by capability, before doing it for them.
function my_plugin_can_manage() {
	return current_user_can( 'manage_options' );
}
$as_admin = my_plugin_can_manage();
wp_set_current_user( 0 );
return array( 'administrator' => $as_admin, 'logged out' => my_plugin_can_manage() );
