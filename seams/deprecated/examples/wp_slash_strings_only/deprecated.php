<?php
// Deprecated in 5.6.0; use wp_slash(). Adds slashes to only string values in an array of values. It reports no deprecation notice of its own.
$f = guide_fixtures();
return guide_deprecated( 'wp_slash_strings_only', array( 'a' => "it's", 'b' => 2 ) );
