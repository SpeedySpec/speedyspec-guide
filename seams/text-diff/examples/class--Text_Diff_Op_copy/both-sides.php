<?php
// A copy has the same lines on both sides unless given a final side.
$copy = new Text_Diff_Op_copy( array( 'a' ) );
return array( $copy->orig, $copy->final );
