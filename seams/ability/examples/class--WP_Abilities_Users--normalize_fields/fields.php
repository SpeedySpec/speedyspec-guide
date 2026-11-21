<?php
// The requested fields, or the default set, always with id first; nested fields are paths like registered.site.
guide_core_abilities();
$users = new WP_Abilities_Users();
return array( guide_private( $users, 'normalize_fields', array() ), guide_private( $users, 'normalize_fields', array( 'fields' => array( 'name' ) ) ), guide_private( $users, 'is_field_requested', 'registered.gmt', array( 'registered' ) ) );
