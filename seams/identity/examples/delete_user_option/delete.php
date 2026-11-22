<?php
// Deletes a user setting for this site or, with $is_global, the global one.
update_user_option( 1, 'theme', 'dark' );
return array( delete_user_option( 1, 'theme' ), get_user_option( 'theme', 1 ) );
