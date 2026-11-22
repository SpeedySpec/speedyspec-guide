<?php
// The default custom background callback: prints a style tag for body.custom-background with the color and image, its position, size, repeat and attachment.
$GLOBALS['_wp_theme_features']['custom-background'] = array( array( 'default-color' => '', 'default-image' => '', 'default-preset' => 'default', 'default-position-x' => 'left', 'default-position-y' => 'top', 'default-size' => 'auto', 'default-repeat' => 'repeat', 'default-attachment' => 'scroll' ) );
set_theme_mod( 'background_color', 'f0f0f0' );
set_theme_mod( 'background_image', 'http://example.org/bg.jpg' );
return guide_render( '_custom_background_cb' );
