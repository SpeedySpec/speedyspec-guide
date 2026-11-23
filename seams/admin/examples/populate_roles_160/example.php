<?php
// Adds the five roles from the old user levels, as WordPress 1.6 did; populate_roles() runs it when a site is installed.
populate_roles_160();
return get_role( 'administrator' )->has_cap( 'manage_options' );
