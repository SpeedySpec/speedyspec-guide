<?php
// Allows the option on its group's settings screen, and records its arguments with the defaults filled in.
register_setting( 'guide', 'guide_color', array( 'type' => 'string', 'default' => 'blue' ) );
global $new_allowed_options;
$args = get_registered_settings()['guide_color'];
return array( $new_allowed_options['guide'], $args['type'], $args['group'], $args['show_in_rest'] );
