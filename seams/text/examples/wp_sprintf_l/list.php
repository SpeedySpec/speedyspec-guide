<?php
// Joins a list for %l: two items with "and", more with commas and ", and"; text after %l is kept.
return array( wp_sprintf_l( '%l!', array( 'a' ) ), wp_sprintf_l( '%l', array( 'a', 'b' ) ), wp_sprintf_l( '%l', array() ), wp_sprintf_l( '%s', array( 'a' ) ) );
