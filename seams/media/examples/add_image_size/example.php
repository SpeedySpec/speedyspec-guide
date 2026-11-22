<?php
// Registers a new image size by name, width, height and crop; uploads afterwards get it as a sub-size.
add_image_size( 'card', 600, 400, true );
return wp_get_additional_image_sizes()['card'];
