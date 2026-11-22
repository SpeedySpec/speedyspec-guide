<?php
// Hooked to admin_init: turns off the default password notice when the user chooses No thanks.
update_user_meta( 1, 'default_password_nag', true );
$_GET['default_password_nag'] = '0';
$_GET['_wpnonce'] = wp_create_nonce( 'default_password_nag' );
$_REQUEST = $_GET;
default_password_nag_handler();
return get_user_meta( 1, 'default_password_nag', true );
