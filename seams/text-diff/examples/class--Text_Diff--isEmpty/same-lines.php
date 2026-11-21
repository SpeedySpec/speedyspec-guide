<?php
// A diff of identical texts has only copies.
return array( ( new Text_Diff( 'native', array( array( 'a' ), array( 'a' ) ) ) )->isEmpty(), ( new Text_Diff( 'native', array( array( 'a' ), array( 'b' ) ) ) )->isEmpty() );
