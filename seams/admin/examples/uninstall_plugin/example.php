<?php
// Runs a plugin's uninstall routine: its uninstall.php, or the callback it registered with register_uninstall_hook().
function guide_uninstall_hello(): void
{
	update_option( 'guide_hello_uninstalled', 'yes' );
}
update_option( 'uninstall_plugins', array( 'hello.php' => 'guide_uninstall_hello' ) );
uninstall_plugin( 'hello.php' );
return get_option( 'guide_hello_uninstalled' );
