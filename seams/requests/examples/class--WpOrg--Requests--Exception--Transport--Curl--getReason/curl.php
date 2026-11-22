<?php
// A cURL transport error with its type, number and reason; ArgumentCount and InvalidArgument build standard messages.
$e = new WpOrg\Requests\Exception\Transport\Curl( 'Timed out', 'curlerror', null, 28 );
return array( $e->getMessage(), $e->getType(), $e->getCode(), $e->getReason(), WpOrg\Requests\Exception\ArgumentCount::create( 'exactly 2 arguments', 1, 'argument' )->getMessage(), WpOrg\Requests\Exception\InvalidArgument::create( 1, '$url', 'string', 'integer' )->getMessage() );
