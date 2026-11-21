<?php
// Writes MO binary and reads it back: headers, contexts and plurals; entries without translations are left out of the file.
$mo = new MO();
$mo->set_header( 'Plural-Forms', 'nplurals=2; plural=n>1;' );
$mo->add_entry( new Translation_Entry( array( 'singular' => 'Post', 'context' => 'noun', 'translations' => array( 'Article' ) ) ) );
$mo->add_entry( new Translation_Entry( array( 'singular' => '%d item', 'plural' => '%d items', 'translations' => array( '%d élément', '%d éléments' ) ) ) );
$mo->add_entry( new Translation_Entry( array( 'singular' => 'Untranslated' ) ) );
$file = tempnam( sys_get_temp_dir(), 'mo' );
$mo->export_to_file( $file );
$read = new MO();
$ok = $read->import_from_file( $file );
unlink( $file );
return array( $ok, bin2hex( substr( $mo->export(), 0, 4 ) ), array_map( 'bin2hex', array_keys( $read->entries ) ), $read->translate( 'Post', 'noun' ), $read->translate_plural( '%d item', '%d items', 1 ), $read->get_plural_forms_count(), basename( $read->get_filename() ) === basename( $file ) );
