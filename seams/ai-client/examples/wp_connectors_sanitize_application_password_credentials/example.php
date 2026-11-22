<?php
// Sanitizes application password credentials saved for a connector: keeps only the trimmed username and password, empty when missing.
return array( wp_connectors_sanitize_application_password_credentials( array( 'username' => ' ada ', 'password' => 'abcd efgh' ) ), wp_connectors_sanitize_application_password_credentials( array( 'username' => 'ada' ) ) );
