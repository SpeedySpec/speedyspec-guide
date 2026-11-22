<?php
// The customized state: values posted for settings (unsanitized_post_values()), each sanitized and validated by its setting (post_value(), set_post_value()); validate_setting_values() gives each setting's validity.
$wp = guide_customizer();
$wp->add_setting( 'guide_color', array( 'default' => '#ffffff', 'sanitize_callback' => 'sanitize_hex_color' ) );
$wp->set_post_value( 'guide_color', '#ABCDEF' );
$good = $wp->post_value( $wp->get_setting( 'guide_color' ) );
$wp->set_post_value( 'guide_color', 'not a color' );
$validity = $wp->validate_setting_values( $wp->unsanitized_post_values() );
return array( $good, $wp->post_value( $wp->get_setting( 'guide_color' ), 'fallback' ), $validity['guide_color'] instanceof WP_Error );
