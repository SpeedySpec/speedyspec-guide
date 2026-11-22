<?php
// Adds each block's theme.json styles to its own stylesheet (or the global styles), so they load with the block.
guide_theme( 'twentytwentyfive' );
wp_enqueue_global_styles();
wp_add_global_styles_for_blocks();
return 'added';
