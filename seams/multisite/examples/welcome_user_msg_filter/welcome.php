<?php
// Gives an empty welcome email the default text; on site_option_welcome_user_email.
return array( str_contains( welcome_user_msg_filter( '' ), 'USERNAME' ), welcome_user_msg_filter( 'Mine' ) );
