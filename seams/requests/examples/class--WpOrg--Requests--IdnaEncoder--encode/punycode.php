<?php
// Encodes an internationalized host name with Punycode; ASCII parts are left; overlong labels throw.
use WpOrg\Requests\IdnaEncoder;
try { IdnaEncoder::encode( str_repeat( 'é', 70 ) . '.com' ); } catch ( WpOrg\Requests\Exception $e ) { $err = $e->getType(); }
return array( IdnaEncoder::encode( 'bücher.example' ), IdnaEncoder::encode( 'example.org' ), IdnaEncoder::to_ascii( 'münchen' ), $err );
