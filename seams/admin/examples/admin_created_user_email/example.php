<?php
// The text of the email asking a user to confirm joining a site, when an administrator adds them on a network.
return str_contains( admin_created_user_email( 'Hi ###USERNAME###' ), 'Hi' );
