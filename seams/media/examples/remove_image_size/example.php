<?php
// Unregisters an image size added with add_image_size(); says whether it was there.
add_image_size( 'card', 600, 400, true );
return array( remove_image_size( 'card' ), has_image_size( 'card' ), remove_image_size( 'card' ) );
