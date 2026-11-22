<?php
// WP_Translations wraps a text domain of the controller for code that expects POMO translations: translate(), translate_plural(), and entries (as Translation_Entry objects) and headers through __get().
$php = tempnam( sys_get_temp_dir(), 'l10n' ) . '.l10n.php';
file_put_contents( $php, '<?php return ' . var_export( array( 'messages' => array( 'Post' => 'Article', "verb\4Post" => 'Publier', '%d item' => "%d élément\0%d éléments" ), 'plural-forms' => 'nplurals=2; plural=n>1;', 'language' => 'fr_FR' ), true ) . ';' );
$controller = new WP_Translation_Controller();
$controller->set_locale( 'fr_FR' );
$controller->load_file( $php, 'guide' );
$t = new WP_Translations( $controller, 'guide' );
$out = array( $t->translate( 'Post' ), $t->translate( 'Post', 'verb' ), $t->translate_plural( '%d item', '%d items', 1 ), $t->headers, array_map( fn( $e ) => array( $e->context, $e->singular, $e->translations, $e->is_plural ), $t->entries ), $t->nope ?? 'null' );
unlink( $php );
return $out;
