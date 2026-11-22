<?php
// Responses: is_redirect(), throw_for_status() throws the status's exception class, decode_body() decodes JSON.
$r = new WpOrg\Requests\Response();
$r->status_code = 404;
$r->body = '{"a":1}';
try { $r->throw_for_status(); } catch ( WpOrg\Requests\Exception\Http $e ) { $err = array( get_class( $e ), $e->getCode(), $e->getReason() ); }
$r->status_code = 301;
$redirect = $r->is_redirect();
$r->status_code = 200;
$r->success = true;
$r->throw_for_status();
$r->body = 'not json';
try { $r->decode_body(); } catch ( WpOrg\Requests\Exception $e ) { $bad = $e->getType(); }
$r->body = '{"a":1}';
return array( $err, $redirect, $r->decode_body(), $r->decode_body( false ), $bad );
