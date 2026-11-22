<?php
// Whether a charset (the site's by default) is UTF-8, under any spelling.
return array( is_utf8_charset(), is_utf8_charset( 'utf8' ), is_utf8_charset( 'UTF-8' ), is_utf8_charset( 'latin1' ) );
