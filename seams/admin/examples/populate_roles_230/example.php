<?php
// Adds unfiltered_upload to administrators, as WordPress 2.3 did; populate_roles() runs it when a site is installed.
populate_roles_230();
return get_role( 'administrator' )->has_cap( 'manage_options' );
