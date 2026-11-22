<?php
// A reader over a string: read() advances, seekto() moves, readint32() reads with the set endianness; length() and read_all().
$reader = new POMO_StringReader( pack( 'V', 7 ) . pack( 'N', 7 ) . 'tail' );
$little = $reader->readint32();
$reader->setEndian( 'big' );
$big = $reader->readint32();
$tail = $reader->read( 10 );
$reader->seekto( 0 );
$reader->setEndian( 'little' );
return array( $little, $big, $tail, $reader->pos(), $reader->readint32array( 1 ), $reader->length(), $reader->str_split( 'abcde', 2 ), $reader->substr( 'abc', 1, 1 ), $reader->strlen( 'é' ), strlen( $reader->read_all() ) );
