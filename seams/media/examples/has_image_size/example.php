<?php
// Whether an image size is registered with add_image_size().
add_image_size( 'card', 600, 400, true );
return array( has_image_size( 'card' ), has_image_size( 'poster' ) );
