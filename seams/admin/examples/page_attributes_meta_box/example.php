<?php
// Prints the Page Attributes box: parent, template and order.
set_current_screen( 'page' );
$GLOBALS['post'] = get_post( wp_insert_post( array( 'post_type' => 'page', 'post_title' => 'About', 'post_status' => 'draft' ) ) );
$html = guide_render( fn() => page_attributes_meta_box( $GLOBALS['post'] ) );
return array( str_contains( $html, 'name="menu_order"' ), str_contains( $html, 'Order' ) );
