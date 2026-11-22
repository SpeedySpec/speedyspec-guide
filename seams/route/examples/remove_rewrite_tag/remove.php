<?php
// Removes a tag and its regex and query.
add_rewrite_tag( '%guide%', '([^/]+)' );
remove_rewrite_tag( '%guide%' );
return in_array( '%guide%', $GLOBALS['wp_rewrite']->rewritecode, true );
