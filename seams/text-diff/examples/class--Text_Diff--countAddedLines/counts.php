<?php
// Lines added, counting both additions and the new side of changes.
$diff = new Text_Diff( 'native', array( array( 'a', 'b' ), array( 'a', 'B', 'c', 'd' ) ) );
return array( $diff->countAddedLines(), $diff->countDeletedLines() );
