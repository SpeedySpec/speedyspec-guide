<?php
// A dictionary whose keys ignore case, stored lowercased.
$d = new WpOrg\Requests\Utility\CaseInsensitiveDictionary( array( 'Content-Type' => 'x' ) );
$d['ETag'] = 'abc';
unset( $d['CONTENT-TYPE'] );
return array( $d['etag'], isset( $d['Content-Type'] ), $d->getAll(), $d['missing'] );
