<?php
// The exception class for a status code, StatusUnknown for others; each knows its code and reason. StatusUnknown takes its code from the Response given as data, so here, given another object, it is 0.
use WpOrg\Requests\Exception\Http;
$classes = array_map( array( Http::class, 'get_class' ), array( 304, 418, 503, 299 ) );
$teapot = new WpOrg\Requests\Exception\Http\Status418();
$unknown = new WpOrg\Requests\Exception\Http\StatusUnknown( null, (object) array( 'status_code' => 299 ) );
return array( $classes, $teapot->getCode(), $teapot->getReason(), $teapot->getMessage(), $unknown->getCode(), $unknown->getReason() );
