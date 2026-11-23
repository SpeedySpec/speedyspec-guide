<?php
// Ajax handler that empties the Inactive Widgets area.
update_option( 'sidebars_widgets', array( 'wp_inactive_widgets' => array( 'search-3' ), 'array_version' => 3 ) );
guide_ajax( 'wp_ajax_delete_inactive_widgets', array( 'removeinactivewidgets' => wp_create_nonce( 'remove-inactive-widgets' ) ) );
return wp_get_sidebars_widgets()['wp_inactive_widgets'];
