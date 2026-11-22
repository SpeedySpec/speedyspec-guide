<?php
// A deletion has only an original side; reversed, it is an addition.
$delete = new Text_Diff_Op_delete( array( 'a' ) );
return array( $delete->final, get_class( $delete->reverse() ) );
