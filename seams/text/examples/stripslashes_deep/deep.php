<?php
// stripslashes() on every string in an array or object.
return stripslashes_deep( array( 'a' => 'It\\\'s', 'b' => array( 'c\\"d' ) ) );
