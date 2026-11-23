<?php
// Whether the user may reorder boxes by dragging, which they can turn off in Screen Options.
$before = wp_is_meta_box_reordering_enabled();
update_user_option( get_current_user_id(), 'meta_box_reordering', 'disabled' );
return array( $before, wp_is_meta_box_reordering_enabled() );
