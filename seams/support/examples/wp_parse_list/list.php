<?php
// A list from an array or a string split on commas and whitespace, empty items left out.
return array( wp_parse_list( 'a, b  c,,d' ), wp_parse_list( array( 'x', 'y' ) ) );
