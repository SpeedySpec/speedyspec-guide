<?php
// Whether pings in and out are off for this environment: true outside production (local, development, staging); filtered by wp_should_disable_pings_for_environment.
return array( wp_get_environment_type(), wp_should_disable_pings_for_environment() );
