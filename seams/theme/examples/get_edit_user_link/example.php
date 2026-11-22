<?php
// A user's edit screen URL (the profile for themselves), for users who can edit them; filtered by get_edit_user_link.
$grace = wp_insert_user( array( 'user_login' => 'grace', 'user_pass' => 'x', 'user_email' => 'g@example.org' ) );
return array( get_edit_user_link(), get_edit_user_link( $grace ) );
