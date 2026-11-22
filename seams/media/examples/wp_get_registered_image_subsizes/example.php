<?php
// Every image size with its width, height and crop, the core sizes read from their options.
add_image_size( 'card', 600, 400, true );
$sizes = wp_get_registered_image_subsizes();
return array( $sizes['thumbnail'], $sizes['card'] );
