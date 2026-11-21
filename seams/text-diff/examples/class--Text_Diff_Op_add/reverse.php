<?php
// An addition has only a final side; reversed, it is a deletion.
$add = new Text_Diff_Op_add( array( 'a' ) );
return array( $add->orig, get_class( $add->reverse() ) );
