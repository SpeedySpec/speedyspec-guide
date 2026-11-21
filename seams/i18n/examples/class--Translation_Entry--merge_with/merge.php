<?php
// Merging adds the other entry's flags, references and comments (the PHP 4 constructor still works).
$a = new Translation_Entry( array( 'singular' => 'x', 'flags' => array( 'fuzzy' ), 'references' => array( 'a.php:1' ) ) );
$b = new Translation_Entry( array( 'singular' => 'x', 'flags' => array( 'php-format' ), 'references' => array( 'b.php:2' ), 'extracted_comments' => 'Note' ) );
$a->merge_with( $b );
$c = new Translation_Entry();
$c->Translation_Entry( array( 'singular' => 'y' ) );
return array( $a->flags, $a->references, $a->extracted_comments, $c->singular );
