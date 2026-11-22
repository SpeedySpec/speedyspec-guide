<?php
// Removes NULL bytes, and backslash-zero sequences.
return wp_kses_no_null( "a\0b\\0c" );
