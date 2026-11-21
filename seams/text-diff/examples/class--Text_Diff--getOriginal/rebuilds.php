<?php
// The edits rebuild both texts.
$diff = new Text_Diff( 'native', array( array( 'a', 'b' ), array( 'b', 'c' ) ) );
return array( $diff->getOriginal(), $diff->getFinal() );
