<?php
// The image settings client-side processing follows, read through the same filters the server uses: sizes, big-image threshold, metadata stripping, bit depth and animated sub-sizes.
$settings = _wp_get_client_side_media_image_settings();
return array( array_keys( $settings ), $settings['image_size_threshold'], $settings['image_strip_meta'] );
