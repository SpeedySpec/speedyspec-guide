<?php
// Whether a value is a serialized string, checked by its form (strictly by default: the last character must close it).
return array( is_serialized( 'a:0:{}' ), is_serialized( 's:3:"abc";' ), is_serialized( 'N;' ), is_serialized( 'b:1;' ), is_serialized( 'hello' ), is_serialized( 5 ) );
