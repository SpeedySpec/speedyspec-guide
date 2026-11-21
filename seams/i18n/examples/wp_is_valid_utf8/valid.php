<?php
// Whether a string is valid UTF-8; surrogates and overlong forms are not. _wp_is_valid_utf8_fallback() does it without mbstring.
return array( wp_is_valid_utf8( 'café 🙂' ), wp_is_valid_utf8( "caf\xE9" ), wp_is_valid_utf8( "\xED\xA0\x80" ), _wp_is_valid_utf8_fallback( "\xC0\xAF" ), _wp_is_valid_utf8_fallback( 'ok' ) );
