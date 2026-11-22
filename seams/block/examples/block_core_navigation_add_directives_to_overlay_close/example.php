<?php
// Adds the Interactivity API directives to the overlay's close block.
$tags = new WP_HTML_Tag_Processor( '<div><button class="wp-block-navigation-overlay-close">Close</button></div>' );
return block_core_navigation_add_directives_to_overlay_close( $tags );
