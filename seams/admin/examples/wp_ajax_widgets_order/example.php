<?php
// Ajax handler that saves the order of widgets in each widget area after dragging.
$sent = guide_ajax( 'wp_ajax_widgets_order', array( 'sidebars' => array( 'sidebar-1' => 'widget-1_search-2' ), 'savewidgets' => wp_create_nonce( 'save-sidebar-widgets' ) ) );
return $sent;
