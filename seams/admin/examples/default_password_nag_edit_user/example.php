<?php
// Hooked to profile_update: turns off the default password notice when the user changes the password WordPress generated.
update_user_meta( 1, 'default_password_nag', true );
$old = get_userdata( 1 );
wp_set_password( 'a new password', 1 );
default_password_nag_edit_user( 1, $old );
return get_user_meta( 1, 'default_password_nag', true );
