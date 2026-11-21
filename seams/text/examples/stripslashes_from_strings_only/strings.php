<?php
// stripslashes() for strings; anything else is returned as it is.
return array( stripslashes_from_strings_only( 'a\\\'b' ), stripslashes_from_strings_only( 5 ) );
