<?php
// The reverse diff goes from the final text back to the original.
$diff = new Text_Diff( 'native', array( array( 'a' ), array( 'a', 'b' ) ) );
$rev = $diff->reverse();
return array( $rev->getOriginal(), $rev->getFinal(), get_class( $rev->getDiff()[1] ) );
