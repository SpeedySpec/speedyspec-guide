<?php
// The global WP_Roles, created on first use, with the roles from the {prefix}user_roles option.
return array( get_class( wp_roles() ), array_keys( wp_roles()->get_names() ) );
