<?php
// Truncates a slug to a length, keeping percent-encoded characters whole; deprecated in 3.9.0 for utf8_uri_encode().
return _truncate_post_slug( 'a-very-long-slug-%e2%98%83-here', 20 );
