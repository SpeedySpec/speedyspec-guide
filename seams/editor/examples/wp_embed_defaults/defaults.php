<?php
// The default embed size: the theme's content width (500 without one) and 1.5 times that high, at most 1000; embed_defaults filters it.
$plain = wp_embed_defaults();
$GLOBALS['content_width'] = 800;
$wide = wp_embed_defaults();
add_filter( 'embed_defaults', fn( $size, $url ) => array( 'width' => 320, 'height' => 180 ), 10, 2 );
return array( $plain, $wide, wp_embed_defaults( 'https://video.example/1' ) );
