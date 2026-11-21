<?php
// Whether an array is keyed rather than a list numbered from 0; the old-style IXR_Value() constructor still works.
$value = new IXR_Value( 1 );
$value->IXR_Value( 'two' );
return array( $value->isStruct( array( 'a', 'b' ) ), $value->isStruct( array( 1 => 'a' ) ), $value->type );
