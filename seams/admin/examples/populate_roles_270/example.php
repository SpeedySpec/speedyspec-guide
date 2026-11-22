<?php
// Adds install_plugins and update_themes to administrators, as WordPress 2.7 did; populate_roles() runs it when a site is installed.
populate_roles_270();
return get_role( 'administrator' )->has_cap( 'manage_options' );
