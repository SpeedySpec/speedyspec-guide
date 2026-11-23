<?php
// Ajax handler for saving a widget in the Customizer, through the Customizer's widgets component.
require_once ABSPATH . WPINC . '/class-wp-customize-manager.php';
$GLOBALS['wp_customize'] = new WP_Customize_Manager();
$sent = json_decode( guide_ajax( 'wp_ajax_update_widget', array( 'widget-id' => 'search-2', 'nonce' => wp_create_nonce( 'update-widget' ) ) ), true );
return $sent['success'] ?? $sent;
