<?php
// The default options, the certificate path, and the transport chosen for capabilities; add_transport() registers another.
use WpOrg\Requests\Requests;
// get_default_options() is protected; request() uses it.
$d = Closure::bind( fn() => self::get_default_options(), null, Requests::class )();
Requests::add_transport( 'Guide_Queue_Transport' );
return array( $d['timeout'], $d['connect_timeout'], $d['useragent'], $d['redirects'], $d['follow_redirects'], basename( $d['verify'] ), basename( Requests::get_certificate_path() ), Closure::bind( fn() => self::get_transport_class(), null, Requests::class )(), Requests::has_capabilities( array( 'ssl' => true ) ), get_class( Closure::bind( fn() => self::get_transport(), null, Requests::class )() ) );
