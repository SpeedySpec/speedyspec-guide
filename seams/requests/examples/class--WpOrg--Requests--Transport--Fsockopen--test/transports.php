<?php
// The two real transports report whether they can work here, and with which capabilities; Fsockopen formats a GET URL.
use WpOrg\Requests\Transport\Curl;
use WpOrg\Requests\Transport\Fsockopen;
$f = new Fsockopen();
return array( Fsockopen::test(), Fsockopen::test( array( 'ssl' => true ) ), is_bool( Curl::test() ), Closure::bind( fn() => $this->format_get( array( 'path' => '/a', 'query' => 'x=1' ), array( 'y' => 2 ) ), $f, Fsockopen::class )(), Closure::bind( fn() => $this->accept_encoding(), $f, Fsockopen::class )() );
