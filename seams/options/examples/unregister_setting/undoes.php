<?php
// Removes the setting, its group entry, its default and its sanitize callback.
register_setting( 'guide', 'guide_color', array( 'default' => 'blue', 'sanitize_callback' => 'strtoupper' ) );
unregister_setting( 'guide', 'guide_color' );
global $new_allowed_options;
return array( isset( get_registered_settings()['guide_color'] ), $new_allowed_options['guide'], get_option( 'guide_color' ), has_filter( 'sanitize_option_guide_color' ) );
