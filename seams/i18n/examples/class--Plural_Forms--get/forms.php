<?php
// Parses a Plural-Forms expression into tokens (shunting-yard) and evaluates it for a number, caching each result; a bad expression throws.
$polish = new Plural_Forms( 'n==1 ? 0 : (n%10>=2 && n%10<=4 && (n%100<12 || n%100>14)) ? 1 : 2' );
$forms = array_map( array( $polish, 'get' ), array( 1, 2, 5, 12, 22, 25 ) );
try { new Plural_Forms( 'n ++ 1' ); } catch ( Exception $e ) { $forms[] = $e->getMessage(); }
return $forms;
