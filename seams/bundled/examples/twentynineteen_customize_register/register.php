<?php
// Adds the Customizer settings: live title, tagline and header text color, the primary color (default or custom) with its hue, and image filters on featured images; on customize_register.
guide_theme( 'twentynineteen' );
require_once ABSPATH . WPINC . '/class-wp-customize-manager.php';
$manager = new WP_Customize_Manager();
$manager->register_controls();
twentynineteen_customize_register( $manager );
return array( $manager->get_setting( 'primary_color' )->default, $manager->get_setting( 'primary_color_hue' )->default, $manager->get_setting( 'image_filter' )->default, $manager->get_setting( 'blogname' )->transport );
