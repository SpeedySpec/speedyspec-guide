<?php
// Deprecated in 5.5.0; use wp_check_comment_disallowed_list(). Does comment contain disallowed characters or words. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'wp_blacklist_check', 'Ada', 'grace@example.org', 'https://example.org/a?b=1&c=2', 'Nice', '127.0.0.1', 'UA' );
