<?php
// norig() and nfinal() count each side's lines; a side the edit doesn't have counts 0.
$add = new Text_Diff_Op_add( array( 'x', 'y' ) );
return array( $add->norig(), $add->nfinal() );
