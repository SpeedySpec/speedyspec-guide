<?php
// While the page is buffered, captures the block, global and late styles printed after the head and moves them into it, at a placeholder after the block library's styles; not for embeds.
wp_hoist_late_printed_styles();
return array( str_contains( implode( '', (array) wp_styles()->get_data( 'wp-block-library', 'after' ) ), 'wp_block_styles_on_demand_placeholder' ) );
