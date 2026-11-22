<?php
// Prints a feed's items as a list, up to 10 by default; a feed that fails shows its error only to administrators, and an empty one says it may be down.
return guide_render( fn() => wp_widget_rss_output( new WP_Error( 'feed', 'No feed.' ) ) );
