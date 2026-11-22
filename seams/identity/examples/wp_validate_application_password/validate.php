<?php
// On determine_current_user: authenticates a REST or XML-RPC request by the Basic Authorization application password; elsewhere passes the user on.
return array( wp_validate_application_password( 5 ), wp_validate_application_password( false ) );
