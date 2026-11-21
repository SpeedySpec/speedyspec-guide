<?php
// The base renderer prints the classic diff format.
$diff = new Text_Diff( 'native', array( array( 'a', 'b' ), array( 'a', 'c' ) ) );
return ( new Text_Diff_Renderer() )->render( $diff );
