<?php
// Adds install_themes to administrators, as WordPress 2.8 did; populate_roles() runs it when a site is installed.
populate_roles_280();
return get_role( 'administrator' )->has_cap( 'manage_options' );
