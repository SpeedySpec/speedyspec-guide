<?php
// Deprecated in 3.0.0. Callback used to change %uXXXX to &#YYY; syntax. It reports no deprecation notice of its own.
$f = guide_fixtures();
return guide_deprecated( 'funky_javascript_callback', array( '<pre>a</pre>', 'a' ) );
