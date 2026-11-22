<?php
// The theme's Customizer settings: live title and tagline, Display Site Title, and Excerpt or Full text on archives (sanitized to excerpt), plus the background color control. The theme makes one when it loads.
guide_theme( 'twentytwentyone' );
require_once ABSPATH . WPINC . '/class-wp-customize-manager.php';
$manager = new WP_Customize_Manager();
do_action( 'customize_register', $manager );
$excerpt = $manager->get_setting( 'display_excerpt_or_full_post' );
return array( $excerpt->default, $excerpt->sanitize( 'nope' ), $manager->get_control( 'display_title_and_tagline' )->section, Twenty_Twenty_One_Customize::sanitize_checkbox( true ), Twenty_Twenty_One_Customize::sanitize_checkbox( 'yes' ) );
