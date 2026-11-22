<?php
// Queues the global styles stylesheet from theme.json (block styles separately when loaded on demand), in the head or the footer; on wp_enqueue_scripts and wp_footer.
guide_theme( 'twentytwentyfive' );
wp_enqueue_global_styles();
return array( wp_style_is( 'global-styles' ), strlen( implode( '', (array) wp_styles()->get_data( 'global-styles', 'after' ) ) ) > 1000 );
