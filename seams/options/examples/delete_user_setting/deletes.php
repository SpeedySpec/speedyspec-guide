<?php
// Deletes settings by name, and returns whether any was deleted.
wp_set_current_user( 1 );
set_user_setting( 'editor', 'html' );
set_user_setting( 'mfold', 'o' );
return array( delete_user_setting( 'editor' ), get_user_option( 'user-settings', 1 ), delete_user_setting( 'missing' ) );
