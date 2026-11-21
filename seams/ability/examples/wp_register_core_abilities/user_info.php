<?php
// core/get-user-info needs a logged-in user; core/get-environment-info needs view_site_health_checks.
guide_core_abilities();
return array( wp_get_ability( 'core/get-user-info' )->check_permissions(), wp_get_ability( 'core/get-environment-info' )->check_permissions(), array_keys( wp_get_ability( 'core/get-environment-info' )->get_output_schema()['properties'] ) );
