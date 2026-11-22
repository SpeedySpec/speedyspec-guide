<?php
// The constructor calls init().
$r = new WP_Rewrite();
return array( $r->permalink_structure, $r->index, $r->using_permalinks() );
