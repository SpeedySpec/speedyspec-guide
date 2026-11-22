<?php
// A table showing the lines that differ between two texts, from Text_Diff; empty when they are the same.
return array( wp_text_diff( "one\ntwo", "one\nthree" ), wp_text_diff( 'same', 'same' ) );
