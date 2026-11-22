<?php
// Whether core blocks load their own styles only when used, instead of one block library stylesheet: true for block themes (and classic themes that load styles on demand), never in the admin, feeds or REST; should_load_separate_core_block_assets filters it.
$classic = wp_should_load_separate_core_block_assets();
guide_theme( 'twentytwentyfive' );
return array( $classic, wp_should_load_separate_core_block_assets() );
