<?php
// Hooked to dynamic_sidebar_params on the widgets screen: swaps each widget's display callback for its form.
$GLOBALS['wp_registered_widgets']['search-2'] = array( 'id' => 'search-2', 'name' => 'Search', 'callback' => 'wp_widget_search' );
$params = wp_list_widget_controls_dynamic_sidebar( array( array( 'widget_id' => 'search-2', 'widget_name' => 'Search' ), array() ) );
return $params[0]['_display'] ?? $params[0]['before_widget'];
