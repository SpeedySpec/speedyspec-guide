<?php
// The .l10n.php format: a PHP array exported in a short, minified form.
$php = tempnam( sys_get_temp_dir(), 'l10n' ) . '.l10n.php';
file_put_contents( $php, '<?php return ' . var_export( array( 'messages' => array( 'Post' => 'Article', "verb\4Post" => 'Publier', '%d item' => "%d élément\0%d éléments" ), 'plural-forms' => 'nplurals=2; plural=n>1;', 'language' => 'fr_FR' ), true ) . ';' );
$file = WP_Translation_File::create( $php );
$file->entries();
$out = $file->export();
unlink( $php );
return $out;
