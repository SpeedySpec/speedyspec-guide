<?php
// Every setting of the current user, parsed from the cookie.
wp_set_current_user( 1 );
$_COOKIE['wp-settings-1'] = 'editor=html&mfold=o';
return get_all_user_settings();
