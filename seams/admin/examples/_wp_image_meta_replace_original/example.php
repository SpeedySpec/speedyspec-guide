<?php
// Updates an image's metadata after its original was replaced by a scaled or rotated copy, keeping the original's name as original_image.
$meta = _wp_image_meta_replace_original( array( 'path' => '/uploads/photo-scaled.jpg', 'file' => 'photo-scaled.jpg', 'width' => 2560, 'height' => 1707 ), '/uploads/photo.jpg', array( 'file' => '2026/11/photo.jpg', 'width' => 4000, 'height' => 2667 ), 0 );
return $meta;
