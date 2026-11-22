<?php
// A redirect location with spaces encoded and characters not allowed in a URL removed, and newlines stripped so no header can be added.
return wp_sanitize_redirect( "https://example.org/a b/<x>\r\nSet-Cookie: y" );
