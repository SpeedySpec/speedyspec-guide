<?php
// Whether the site can use application passwords: it uses HTTPS, or is a local environment.
return array( wp_is_application_passwords_supported(), wp_get_environment_type() );
