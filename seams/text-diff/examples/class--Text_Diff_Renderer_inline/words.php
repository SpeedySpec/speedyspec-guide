<?php
// Marks changes inline with <ins> and <del>, word by word within a changed line.
$diff = new Text_Diff( 'native', array( array( 'the quick fox' ), array( 'the slow fox' ) ) );
return ( new Text_Diff_Renderer_inline() )->render( $diff );
