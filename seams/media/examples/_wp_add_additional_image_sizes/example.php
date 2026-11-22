<?php
// Hooked to init: registers the 1536x1536 and 2048x2048 image sizes for large screens.
remove_image_size( '1536x1536' );
_wp_add_additional_image_sizes();
return wp_get_additional_image_sizes()['1536x1536'];
