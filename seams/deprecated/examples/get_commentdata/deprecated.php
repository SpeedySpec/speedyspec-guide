<?php
// Deprecated in 2.7.0; use get_comment(). Retrieve an array of comment data about comment $comment_id. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'get_commentdata', $f['comment'] );
