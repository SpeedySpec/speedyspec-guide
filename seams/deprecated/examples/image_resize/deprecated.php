<?php
// Deprecated in 3.5.0; use wp_get_image_editor(). Scale down an image to fit a particular size and save a new copy of the image. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'image_resize', '/no/such/file.png', 10, 10 );
