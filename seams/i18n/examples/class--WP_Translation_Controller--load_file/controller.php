<?php
// The controller loads translation files per text domain and locale, and translates through them.
$php = tempnam( sys_get_temp_dir(), 'l10n' ) . '.l10n.php';
file_put_contents( $php, '<?php return ' . var_export( array( 'messages' => array( 'Post' => 'Article', "verb\4Post" => 'Publier', '%d item' => "%d élément\0%d éléments" ), 'plural-forms' => 'nplurals=2; plural=n>1;', 'language' => 'fr_FR' ), true ) . ';' );
$controller = new WP_Translation_Controller();
$controller->set_locale( 'fr_FR' );
$loaded = $controller->load_file( $php, 'guide' );
$out = array( $loaded, $controller->get_locale(), $controller->is_textdomain_loaded( 'guide' ), $controller->translate( 'Post', '', 'guide' ), $controller->translate( 'Post', 'verb', 'guide' ), $controller->translate( 'Nope', '', 'guide' ), $controller->translate_plural( array( '%d item', '%d items' ), 5, '', 'guide' ), $controller->has_translation( 'Post', 'guide' ), $controller->get_headers( 'guide' ), count( $controller->get_entries( 'guide' ) ), $controller->load_file( '/nonexistent.mo', 'guide' ) );
unlink( $php );
return $out;
