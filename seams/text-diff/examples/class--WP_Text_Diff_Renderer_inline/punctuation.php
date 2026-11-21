<?php
// WordPress's version splits words at every character that isn't a word character, so punctuation is its own token.
$diff = new Text_Diff( 'native', array( array( 'one,two' ), array( 'one,three' ) ) );
return ( new WP_Text_Diff_Renderer_inline() )->render( $diff );
