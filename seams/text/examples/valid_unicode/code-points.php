<?php
// Says whether a number is a code point that XML allows.
return array( valid_unicode( 65 ), valid_unicode( 0xD800 ), valid_unicode( 0x110000 ) );
