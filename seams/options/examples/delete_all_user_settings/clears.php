<?php
// Empties the user-settings user option (and expires the cookie).
wp_set_current_user( 1 );
set_user_setting( 'editor', 'html' );
delete_all_user_settings();
return get_user_option( 'user-settings', 1 );
