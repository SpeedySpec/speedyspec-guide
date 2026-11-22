<?php
// IPv6 addresses: compress zero runs to ::, uncompress them, and check validity, with an IPv4 tail.
use WpOrg\Requests\Ipv6;
return array( Ipv6::compress( 'FF01:0:0:0:0:0:0:101' ), Ipv6::uncompress( '::1' ), Ipv6::compress( '0:0:0:0:0:FFFF:129.144.52.38' ), Ipv6::check_ipv6( '2001:db8::1' ), Ipv6::check_ipv6( '2001:::1' ), Ipv6::check_ipv6( '::ffff:1.2.3.4' ) );
