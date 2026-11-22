<?php
// Whether visitors may sign up as users, from the network's registration option (user or all); on option_users_can_register.
$none = users_can_register_signup_filter();
update_site_option( 'registration', 'user' );
return array( $none, users_can_register_signup_filter() );
