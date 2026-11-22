<?php
// The editor settings classic themes' theme supports give: disabling custom colors, gradients, font sizes and so on.
add_theme_support( 'disable-custom-colors' );
$s = get_classic_theme_supports_block_editor_settings();
return array( $s['disableCustomColors'], isset( $s['colors'] ) );
