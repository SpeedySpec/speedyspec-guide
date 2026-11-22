<?php
// Deprecated in 4.6.0. The Google Video embed handler callback. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'wp_embed_handler_googlevideo', array( '<pre>a</pre>', 'a' ), array(), 'https://example.org/a?b=1&c=2', array() );
