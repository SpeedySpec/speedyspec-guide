<?php
// Says whether a string is a plausible email address, returning it, or false.
return array( is_email( 'me@example.org' ), is_email( 'me@localhost' ), is_email( 'not-an-email' ) );
