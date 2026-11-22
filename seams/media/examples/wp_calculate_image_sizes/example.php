<?php
// The sizes value for an image of a width: (max-width: Wpx) 100vw, Wpx; filtered by wp_calculate_image_sizes.
return array( wp_calculate_image_sizes( array( 300, 200 ) ), wp_calculate_image_sizes( 'medium', null, null, guide_attachment() ) );
