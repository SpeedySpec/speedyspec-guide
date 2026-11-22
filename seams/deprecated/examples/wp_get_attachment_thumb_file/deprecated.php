<?php
// Deprecated in 6.1.0. Retrieves thumbnail for an attachment. Note that this works only for the (very) old image metadata style where 'thumb' was set, and the 'sizes' array did not exist. This function returns false for the newer image metadata style despite that 'thumbnail' is present in the 'sizes' array. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'wp_get_attachment_thumb_file' );
