<?php
// A connector's application password credentials from its environment variable, constant or option, with where they came from.
update_option( 'guide_remote_site', array( 'username' => 'ada', 'password' => 'abcd efgh ijkl' ) );
return wp_connectors_get_application_password_credentials( array( 'setting_name' => 'guide_remote_site' ) );
