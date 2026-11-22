<?php
// The image sizes added with add_image_size(), by name, with their width, height and crop.
add_image_size( 'card', 600, 400, true );
add_image_size( 'banner', 1600, 0 );
return wp_get_additional_image_sizes();
