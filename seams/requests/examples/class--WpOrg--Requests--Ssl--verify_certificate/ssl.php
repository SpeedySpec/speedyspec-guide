<?php
// Matches a host against a certificate's subject alternative names (or common name), allowing a leading wildcard label.
use WpOrg\Requests\Ssl;
$cert = array( 'subject' => array( 'CN' => 'example.org' ), 'extensions' => array( 'subjectAltName' => 'DNS: www.example.org, DNS: *.cdn.example.org' ) );
return array( Ssl::verify_certificate( 'www.example.org', $cert ), Ssl::verify_certificate( 'a.cdn.example.org', $cert ), Ssl::verify_certificate( 'a.b.cdn.example.org', $cert ), Ssl::verify_certificate( 'example.org', $cert ), Ssl::verify_reference_name( '*.example.org' ), Ssl::verify_reference_name( 'a.*.example.org' ), Ssl::match_domain( 'x.example.org', '*.example.org' ) );
