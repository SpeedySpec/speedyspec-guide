<?php
// Applies the callback to every scalar in nested arrays and objects' properties.
$object = (object) array( 'b' => ' y ' );
return map_deep( array( ' x ', array( ' z ' ), $object ), 'trim' );
