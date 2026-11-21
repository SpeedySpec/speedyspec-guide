<?php
// The regular expression wptexturize() splits on: tags, comments and, when given, shortcodes.
return count( preg_split( _get_wptexturize_split_regex(), 'a<b>c', -1, PREG_SPLIT_DELIM_CAPTURE ) );
