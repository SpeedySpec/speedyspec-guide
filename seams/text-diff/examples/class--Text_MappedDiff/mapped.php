<?php
// Compares mapped lines (here, lowercased) but reports the original lines.
$from = array( 'Hello', 'World' );
$to = array( 'HELLO', 'there' );
$diff = new Text_MappedDiff( $from, $to, array_map( 'strtolower', $from ), array_map( 'strtolower', $to ) );
$ops = $diff->getDiff();
return array( get_class( $ops[0] ), $ops[0]->orig, $ops[0]->final );
