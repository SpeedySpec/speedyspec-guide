<?php
// A nonce is tied to one action and the current user; it fails for any other action, or if it is altered.
$nonce = wp_create_nonce( 'my_plugin_delete_item_7' );
return array(
	'same action'    => false !== wp_verify_nonce( $nonce, 'my_plugin_delete_item_7' ),
	'other action'   => wp_verify_nonce( $nonce, 'my_plugin_delete_item_8' ),
	'altered'        => wp_verify_nonce( strrev( $nonce ), 'my_plugin_delete_item_7' ),
	'missing'        => wp_verify_nonce( '', 'my_plugin_delete_item_7' ),
);
