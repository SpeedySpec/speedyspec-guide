<?php
// On authenticate for API requests: a user by an application password (which then can't be used to log in elsewhere); outside API requests, or when application passwords are unavailable, the user is passed on.
return array( wp_authenticate_application_password( null, 'admin', 'abcd efgh ijkl mnop qrst uvwx' ), wp_is_application_passwords_available() );
