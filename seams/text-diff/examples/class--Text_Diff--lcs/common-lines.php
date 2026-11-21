<?php
// The number of lines both texts share, in order.
return ( new Text_Diff( 'native', array( array( 'a', 'b', 'c' ), array( 'a', 'x', 'c' ) ) ) )->lcs();
