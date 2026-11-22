<?php
// Makes a value encodable: strings converted to valid UTF-8, arrays and objects walked to the depth limit; an exception when it is too deep.
return _wp_json_sanity_check( array( 'a' => "\xB1x" ), 5 );
