<?php
// Adds fetchpriority="high" to loading attributes for the first image larger than wp_min_priority_img_pixels that isn't lazy.
return array( wp_maybe_add_fetchpriority_high_attr( array(), 'img', array( 'width' => 1200, 'height' => 800 ) ), wp_maybe_add_fetchpriority_high_attr( array(), 'img', array( 'width' => 1200, 'height' => 800 ) ) );
