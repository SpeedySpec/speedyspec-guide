<?php
// Ajax handler for saving or removing a widget on the classic widgets screen, through its update callback.
$sent = guide_ajax( 'wp_ajax_save_widget', array( 'id_base' => 'search', 'widget-id' => 'search-2', 'sidebar' => 'sidebar-1', 'widget-search' => array( 2 => array( 'title' => 'Find' ) ), 'savewidgets' => wp_create_nonce( 'save-sidebar-widgets' ) ) );
return array( $sent, get_option( 'widget_search' )[2]['title'] ?? null );
