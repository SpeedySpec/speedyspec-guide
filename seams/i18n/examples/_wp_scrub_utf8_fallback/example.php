<?php
// Replaces each maximal invalid span with U+FFFD, without mbstring.
return _wp_scrub_utf8_fallback( "a\xE2\x82b\xFFc" );
