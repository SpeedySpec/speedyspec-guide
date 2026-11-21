<?php
// An entry: singular, plural (which makes it plural), context, translations, comments, references and flags; key() is the context and singular joined by \x04.
$entry = new Translation_Entry( array( 'singular' => 'Post', 'plural' => 'Posts', 'context' => 'noun', 'translations' => array( 'Article', 'Articles' ), 'references' => array( 'a.php:1' ) ) );
$empty = new Translation_Entry();
return array( $entry->is_plural, bin2hex( $entry->key() ), $empty->key(), $empty->singular );
