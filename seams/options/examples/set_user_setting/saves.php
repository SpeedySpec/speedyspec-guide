<?php
// Saves one setting into the user-settings user option.
wp_set_current_user( 1 );
set_user_setting( 'editor', 'html' );
return array( get_user_setting( 'editor' ), get_user_option( 'user-settings', 1 ) );
