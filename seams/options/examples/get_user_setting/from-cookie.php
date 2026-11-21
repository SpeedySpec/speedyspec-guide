<?php
// The current user's settings come from the wp-settings-<user id> cookie when the browser sent one.
wp_set_current_user( 1 );
$_COOKIE['wp-settings-1'] = 'editor=html&mfold=o';
return get_user_setting( 'editor' );
