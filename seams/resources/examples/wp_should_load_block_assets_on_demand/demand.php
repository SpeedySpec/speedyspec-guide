<?php
// Whether block assets load only for blocks on the page: as separate core block assets do, never in the admin, feeds or REST; should_load_block_assets_on_demand filters it.
guide_theme( 'twentytwentyfive' );
return wp_should_load_block_assets_on_demand();
