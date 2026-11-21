<?php
// UTF-8 to ISO-8859-1 without mbstring; characters outside Latin-1 become ?.
return bin2hex( _wp_utf8_decode_fallback( 'é€' ) );
