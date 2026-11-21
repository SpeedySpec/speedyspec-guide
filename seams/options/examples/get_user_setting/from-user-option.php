<?php
// Without the cookie, they come from the user-settings user option.
wp_set_current_user( 1 );
update_user_option( 1, 'user-settings', 'editor=html', false );
return get_user_setting( 'editor' );
