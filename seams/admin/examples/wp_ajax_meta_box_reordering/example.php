<?php
// Ajax handler that remembers whether the user turned dragging boxes to reorder them on or off, in their meta_box_reordering option.
guide_ajax( 'wp_ajax_meta_box_reordering', array( 'enabled' => '0', 'screenoptionnonce' => wp_create_nonce( 'screen-options-nonce' ) ) );
return get_user_option( 'meta_box_reordering' );
