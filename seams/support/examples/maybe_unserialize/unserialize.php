<?php
// Unserializes a value when it is a serialized string; anything else is given back.
return array( maybe_unserialize( 'a:1:{i:0;s:1:"x";}' ), maybe_unserialize( 'plain' ), maybe_unserialize( 'b:0;' ) );
