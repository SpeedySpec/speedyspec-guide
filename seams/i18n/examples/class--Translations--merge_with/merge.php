<?php
// merge_with() takes the other's entries, replacing same keys; merge_originals_with() merges into existing entries and adds new ones.
$a = new Translations();
$a->add_entry( array( 'singular' => 'x', 'translations' => array( 'X' ), 'references' => array( 'a:1' ) ) );
$b = new Translations();
$b->add_entry( array( 'singular' => 'x', 'translations' => array( 'Y' ), 'references' => array( 'b:2' ) ) );
$b->add_entry( array( 'singular' => 'z' ) );
$c = clone $a;
$a->merge_with( $b );
$c->merge_originals_with( $b );
return array( $a->entries['x']->translations, $c->entries['x']->translations, $c->entries['x']->references, array_keys( $c->entries ) );
