<?php
// 'auto', or lines given without an engine name, picks xdiff when that extension is loaded and native otherwise.
$diff = new Text_Diff( array( 'a' ), array( 'b' ) );
return array( extension_loaded( 'xdiff' ), $diff->countAddedLines(), $diff->countDeletedLines() );
