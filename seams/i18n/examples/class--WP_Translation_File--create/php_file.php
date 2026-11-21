<?php
// The faster translation files: create() reads a .mo or .l10n.php file by its type; translate() and get_plural_form() use its headers; transform() converts between the two. Files are read lazily, on first use; an unknown type or an unreadable file gives false.
$mo = new MO();
$mo->set_header( 'Plural-Forms', 'nplurals=2; plural=n>1;' );
$mo->add_entry( new Translation_Entry( array( 'singular' => 'Post', 'translations' => array( 'Article' ) ) ) );
$mo->add_entry( new Translation_Entry( array( 'singular' => '%d item', 'plural' => '%d items', 'translations' => array( '%d élément', '%d éléments' ) ) ) );
$mofile = tempnam( sys_get_temp_dir(), 'mo' ) . '.mo';
$mo->export_to_file( $mofile );
$file = WP_Translation_File::create( $mofile );
$out = array( get_class( $file ), $file->translate( 'Post' ), $file->translate( 'Nope' ), $file->get_plural_form( 2 ), $file->headers(), WP_Translation_File::transform( $mofile, 'php' ), WP_Translation_File::create( $mofile, 'pot' ), WP_Translation_File::create( '/nonexistent.mo' ), $file->error() );
unlink( $mofile );
return $out;
