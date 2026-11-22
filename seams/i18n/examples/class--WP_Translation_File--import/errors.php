<?php
// import() copies another file's headers and entries; entries() lists them; a file that doesn't return an array reports an error.
$broken = tempnam( sys_get_temp_dir(), 'l10n' ) . '.l10n.php';
file_put_contents( $broken, '<?php return 1;' );
$missing = WP_Translation_File::create( $broken );
$missing->entries();
unlink( $broken );
$php = tempnam( sys_get_temp_dir(), 'l10n' ) . '.l10n.php';
file_put_contents( $php, '<?php return ' . var_export( array( 'messages' => array( 'Post' => 'Article', "verb\4Post" => 'Publier', '%d item' => "%d élément\0%d éléments" ), 'plural-forms' => 'nplurals=2; plural=n>1;', 'language' => 'fr_FR' ), true ) . ';' );
$source = WP_Translation_File::create( $php );
$target = WP_Translation_File::create( $php );
// import() is protected; transform() uses it.
$imported = Closure::bind( fn() => $this->import( $source ), $target, WP_Translation_File::class )();
$entries = $target->entries();
$text = WP_Translation_File::transform( $php, 'mo' );
unlink( $php );
return array( $missing->error(), $imported, $entries, $source->headers(), strlen( $text ) > 20, basename( $source->get_file() ) === basename( $php ) );
