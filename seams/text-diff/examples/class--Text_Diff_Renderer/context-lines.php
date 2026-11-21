<?php
// leading_context_lines and trailing_context_lines keep unchanged lines around each change.
$diff = new Text_Diff( 'native', array( array( 'a', 'b', 'c' ), array( 'a', 'x', 'c' ) ) );
$renderer = new Text_Diff_Renderer( array( 'leading_context_lines' => 1, 'trailing_context_lines' => 1 ) );
return $renderer->render( $diff );
