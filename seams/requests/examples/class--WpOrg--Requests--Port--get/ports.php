<?php
// The default port of a scheme: acap, dict, http and https; others throw.
use WpOrg\Requests\Port;
try { Port::get( 'gopher' ); } catch ( WpOrg\Requests\Exception $e ) { $err = $e->getMessage(); }
return array( Port::get( 'http' ), Port::get( 'HTTPS' ), Port::get( 'acap' ), Port::get( 'dict' ), $err );
