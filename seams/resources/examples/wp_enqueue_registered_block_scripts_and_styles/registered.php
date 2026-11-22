<?php
// Queues every registered block's scripts and styles, unless block assets load on demand, as they do here.
$on_demand = wp_should_load_block_assets_on_demand();
wp_enqueue_registered_block_scripts_and_styles();
return array( $on_demand, wp_style_is( 'wp-block-paragraph' ) );
