<?php
// Registers the core settings, but leaves the groups' allowed options as they were.
global $new_allowed_options;
$before = $new_allowed_options;
_wp_register_initial_settings_for_abilities();
return array( isset( get_registered_settings()['blogname'] ), $new_allowed_options === $before );
