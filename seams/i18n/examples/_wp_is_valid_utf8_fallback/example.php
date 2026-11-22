<?php
// Whether a string is valid UTF-8, without mbstring: overlong and truncated sequences are invalid.
return array( _wp_is_valid_utf8_fallback( 'café' ), _wp_is_valid_utf8_fallback( "\xC0\xAF" ), _wp_is_valid_utf8_fallback( "\xE2\x82" ) );
