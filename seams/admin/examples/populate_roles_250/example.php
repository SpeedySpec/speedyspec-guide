<?php
// Adds edit_dashboard to administrators, as WordPress 2.5 did; populate_roles() runs it when a site is installed.
populate_roles_250();
return get_role( 'administrator' )->has_cap( 'manage_options' );
