<?php
// Ajax handler for a category box's Add New link: inserts a hierarchical term and sends back the checkbox list item and the parent dropdown as XML.
$_POST['action'] = 'add-category';
$sent = guide_ajax( '_wp_ajax_add_hierarchical_term', array( 'action' => 'add-category', 'newcategory' => 'Herbal', 'newcategory_parent' => -1, '_ajax_nonce-add-category' => wp_create_nonce( 'add-category' ) ) );
return array( str_contains( $sent, 'Herbal' ), term_exists( 'Herbal', 'category' ) !== null );
