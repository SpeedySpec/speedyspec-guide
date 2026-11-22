<?php
// ISO-8859-1 to UTF-8 and back without mbstring, as PHP's old utf8_encode() and utf8_decode(): characters outside Latin-1 become ?.
return array( bin2hex( _wp_utf8_encode_fallback( "caf\xE9" ) ), bin2hex( _wp_utf8_decode_fallback( 'café🙂' ) ) );
