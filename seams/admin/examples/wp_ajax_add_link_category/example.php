<?php
// Ajax handler for the link screen's Add New category: inserts each comma-separated link category and sends back their checkbox list items.
update_option( 'link_manager_enabled', 1 );
$sent = guide_ajax( fn() => wp_ajax_add_link_category( 'add-link-category' ), array( 'newcat' => 'Friends, Tools' ), 'add-link-category' );
return array( substr_count( $sent, '<link-category ' ), term_exists( 'Tools', 'link_category' ) !== null );
