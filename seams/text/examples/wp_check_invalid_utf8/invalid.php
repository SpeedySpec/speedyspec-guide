<?php
// Returns an invalid UTF-8 string as an empty string, or with $strip, with each invalid byte replaced by U+FFFD.
return array( wp_check_invalid_utf8( "ok\xC3\x28" ), bin2hex( wp_check_invalid_utf8( "ok\xC3\x28", true ) ) );
