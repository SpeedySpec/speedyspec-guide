<?php
// Adds the core, theme, user and options capabilities added in 3.0 to administrators, as WordPress 3.0 did; populate_roles() runs it when a site is installed.
populate_roles_300();
return get_role( 'administrator' )->has_cap( 'manage_options' );
