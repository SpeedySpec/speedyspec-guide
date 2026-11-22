<?php
// Serializes arrays and objects; strings that are already serialized are serialized again, so they come back as given. Other values are left alone.
return array( maybe_serialize( array( 1, 2 ) ), maybe_serialize( 'plain' ), maybe_serialize( 'a:0:{}' ), maybe_serialize( 5 ) );
