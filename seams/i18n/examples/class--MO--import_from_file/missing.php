<?php
// A missing file, or one without the MO magic number, isn't imported; get_byteorder() reads the magic number's endianness.
$file = tempnam( sys_get_temp_dir(), 'mo' );
file_put_contents( $file, 'not an mo file at all' );
$mo = new MO();
$bad = $mo->import_from_file( $file );
unlink( $file );
return array( $bad, ( new MO() )->import_from_file( '/nonexistent/file.mo' ), $mo->get_byteorder( 0x950412de ), $mo->get_byteorder( 0xde120495 ), $mo->get_byteorder( 1 ) );
