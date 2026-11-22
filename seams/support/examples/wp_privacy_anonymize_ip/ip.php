<?php
// An IP address with its last part zeroed: the last octet of IPv4, the last 80 bits of IPv6; 0.0.0.0 or :: when invalid, or the whole address zeroed when asked.
return array( wp_privacy_anonymize_ip( '192.168.1.42' ), wp_privacy_anonymize_ip( '2001:db8:85a3::8a2e:370:7334' ), wp_privacy_anonymize_ip( 'nope' ), wp_privacy_anonymize_ip( '10.0.0.1', true ) );
