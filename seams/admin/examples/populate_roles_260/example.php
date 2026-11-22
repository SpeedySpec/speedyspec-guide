<?php
// Adds update_plugins and delete_plugins to administrators, as WordPress 2.6 did; populate_roles() runs it when a site is installed.
populate_roles_260();
return get_role( 'administrator' )->has_cap( 'manage_options' );
