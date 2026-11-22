<?php
// The username and password of a username:password string, or both empty when either part is missing.
return array( wp_connectors_parse_application_password_credentials( 'ada:abcd efgh ijkl' ), wp_connectors_parse_application_password_credentials( 'no-colon' ) );
