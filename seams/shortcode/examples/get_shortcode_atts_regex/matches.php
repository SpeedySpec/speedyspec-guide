<?php
// The regular expression shortcode_parse_atts() uses, delimiters included.
return preg_match_all( get_shortcode_atts_regex(), 'a=1 b="2"' );
