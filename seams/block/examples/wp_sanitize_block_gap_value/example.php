<?php
// A block gap value made safe to put in CSS: numbers zero as '0', CSS variables kept, and values with characters that could break out (backslashes, brackets, = or comments) refused as null, recursively for arrays.
return array( wp_sanitize_block_gap_value( '1rem' ), wp_sanitize_block_gap_value( 'var(--wp--preset--spacing--40)' ), wp_sanitize_block_gap_value( '1rem}body{color:red' ), wp_sanitize_block_gap_value( array( 'top' => '2em', 'left' => 'x(' ) ) );
