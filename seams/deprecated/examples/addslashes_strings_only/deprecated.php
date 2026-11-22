<?php
// Deprecated in 5.6.0. Adds slashes only if the provided value is a string. It reports no deprecation notice of its own.
$f = guide_fixtures();
return guide_deprecated( 'addslashes_strings_only', array( 'a' => "it's", 'b' => 2 ) );
