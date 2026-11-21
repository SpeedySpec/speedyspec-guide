<?php
// A change has both sides; reversed, the sides swap.
$rev = ( new Text_Diff_Op_change( array( 'a' ), array( 'b' ) ) )->reverse();
return array( $rev->orig, $rev->final );
