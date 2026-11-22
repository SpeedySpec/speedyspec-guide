<?php
// Removes slashes, in arrays too.
return wp_unslash( array( "it\\'s", array( 'a\\"b' ) ) );
