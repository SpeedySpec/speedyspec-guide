<?php
// Adds the edit_others_pages, publish_pages and related page capabilities, as WordPress 2.1 did; populate_roles() runs it when a site is installed.
populate_roles_210();
return get_role( 'administrator' )->has_cap( 'manage_options' );
