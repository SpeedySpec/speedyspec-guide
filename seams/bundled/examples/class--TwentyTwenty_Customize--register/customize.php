<?php
// The theme's Customizer settings: retina logo, header and footer background, accessible accent colors, header search, author bio, excerpt or full text, and the cover template's options.
require_once ABSPATH . WPINC . '/class-wp-customize-manager.php';
$manager = new WP_Customize_Manager();
guide_theme( 'twentytwenty' );
$manager->register_controls();
TwentyTwenty_Customize::register( $manager );
return array( array_keys( array_filter( $manager->settings(), fn( $s ) => in_array( $s->id, array( 'retina_logo', 'header_footer_background_color', 'accent_hue_active', 'enable_header_search', 'show_author_bio', 'blog_content', 'cover_template_fixed_background', 'cover_template_overlay_opacity' ), true ) ) ), TwentyTwenty_Customize::sanitize_accent_accessible_colors( array( 'content' => array( 'text' => 'red', 'accent' => '#00f' ) ) ), TwentyTwenty_Customize::sanitize_select( 'NOPE', $manager->get_setting( 'blog_content' ) ), TwentyTwenty_Customize::sanitize_checkbox( 1 ) );
