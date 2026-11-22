<?php
// Replaces $matches[N] in a query with the regex match N, URL-encoded; a missing match gives ''.
return WP_MatchesMapRegex::apply( 'index.php?name=$matches[1]&page=$matches[2]&x=$matches[9]', array( 'a b/2', 'a b', '2' ) );
