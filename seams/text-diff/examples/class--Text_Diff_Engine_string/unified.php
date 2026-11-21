<?php
// Reads the edits from an existing unified diff.
$diff = new Text_Diff( 'string', array( "--- a\n+++ b\n@@ -1,2 +1,2 @@\n same\n-old\n+new\n" ) );
return array( $diff->getOriginal(), $diff->getFinal() );
