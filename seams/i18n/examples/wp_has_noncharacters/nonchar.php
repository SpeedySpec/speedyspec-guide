<?php
// Whether a string has Unicode noncharacters (U+FDD0–U+FDEF, and U+FFFE/U+FFFF in any plane); _wp_has_noncharacters_fallback() does it without PCRE's UTF-8 support.
return array( wp_has_noncharacters( "a\u{FDD0}" ), wp_has_noncharacters( "\u{10FFFF}" ), wp_has_noncharacters( 'plain' ), _wp_has_noncharacters_fallback( "\u{FFFE}" ) );
