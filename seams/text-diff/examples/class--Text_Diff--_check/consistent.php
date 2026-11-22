<?php
// Checks that a diff rebuilds and reverses both texts, and that no two edits in a row are of the same kind.
return ( new Text_Diff( 'native', array( array( 'a', 'b' ), array( 'a', 'c' ) ) ) )->_check( array( 'a', 'b' ), array( 'a', 'c' ) );
