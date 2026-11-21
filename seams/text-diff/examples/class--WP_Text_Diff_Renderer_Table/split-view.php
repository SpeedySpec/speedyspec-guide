<?php
// Renders table rows: removed lines on the left, added ones on the right.
$diff = new Text_Diff( 'native', array( array( 'a' ), array( 'a', 'b' ) ) );
return ( new WP_Text_Diff_Renderer_Table() )->render( $diff );
