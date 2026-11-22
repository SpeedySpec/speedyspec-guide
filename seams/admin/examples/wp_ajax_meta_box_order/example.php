<?php
// Ajax handler that remembers the order and column layout of the boxes a user dragged on a screen.
guide_ajax( 'wp_ajax_meta_box_order', array( 'page' => 'post', 'order' => array( 'side' => 'submitdiv,categorydiv' ), 'page_columns' => 2 ), 'meta-box-order' );
return array( get_user_option( 'meta-box-order_post' ), get_user_option( 'screen_layout_post' ) );
