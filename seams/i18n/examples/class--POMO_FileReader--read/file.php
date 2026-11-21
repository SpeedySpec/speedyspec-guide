<?php
// Readers over files: POMO_FileReader reads as it goes, POMO_CachedFileReader reads the whole file into memory; both report end of file and close.
$file = tempnam( sys_get_temp_dir(), 'po' );
file_put_contents( $file, 'abcdef' );
$reader = new POMO_FileReader( $file );
$start = $reader->read( 2 );
$reader->seekto( 4 );
$rest = $reader->read_all();
$eof = $reader->feof();
$reader->close();
$cached = new POMO_CachedFileReader( $file );
$int = new POMO_CachedIntFileReader( $file );
unlink( $file );
return array( $start, $rest, $eof, $reader->is_resource(), $cached->read( 3 ), $cached->length(), get_parent_class( $int ) );
