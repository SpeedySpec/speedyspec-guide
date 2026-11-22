<?php
// unload_file() and unload_textdomain() drop files; normalize_header() capitalizes header names; get_instance() is the shared controller.
$php = tempnam( sys_get_temp_dir(), 'l10n' ) . '.l10n.php';
file_put_contents( $php, '<?php return ' . var_export( array( 'messages' => array( 'Post' => 'Article', "verb\4Post" => 'Publier', '%d item' => "%d élément\0%d éléments" ), 'plural-forms' => 'nplurals=2; plural=n>1;', 'language' => 'fr_FR' ), true ) . ';' );
$controller = new WP_Translation_Controller();
$controller->set_locale( 'fr_FR' );
$controller->load_file( $php, 'guide' );
$file = $controller->unload_file( $php, 'guide' );
$after_file = $controller->is_textdomain_loaded( 'guide' );
$controller->load_file( $php, 'guide' );
$domain = $controller->unload_textdomain( 'guide' );
unlink( $php );
return array( $file, $after_file, $domain, $controller->is_textdomain_loaded( 'guide' ), Closure::bind( fn() => $this->normalize_header( 'plural-forms' ), $controller, WP_Translation_Controller::class )(), WP_Translation_Controller::get_instance() === WP_Translation_Controller::get_instance() );
