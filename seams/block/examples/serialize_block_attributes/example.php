<?php
// A block's attributes as JSON for its comment delimiter, with --, <, > and & escaped as unicode.
return serialize_block_attributes( array( 'text' => 'a -- b <c> & d', 'n' => 1 ) );
