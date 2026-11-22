<?php
// Deprecated in 2.1.0; use get_author_posts_url(). Returns or Prints link to the author's posts. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'get_author_link', false, $f['user'] );
