<?php
// Whether a string has Unicode noncharacters, without PCRE's UTF-8 support.
return array( _wp_has_noncharacters_fallback( "x\u{FDEF}" ), _wp_has_noncharacters_fallback( 'plain' ) );
