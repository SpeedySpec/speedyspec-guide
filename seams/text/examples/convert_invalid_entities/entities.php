<?php
// Converts the numeric entities 128 to 159, which mean Windows-1252 characters, to the Unicode ones.
return convert_invalid_entities( '&#150; &#8211;' );
