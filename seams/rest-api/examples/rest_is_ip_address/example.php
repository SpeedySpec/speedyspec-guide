<?php
// The IP address if a string is an IPv4 or IPv6 address, else false.
return array( rest_is_ip_address( '192.168.1.1' ), rest_is_ip_address( '::1' ), rest_is_ip_address( '300.1.1.1' ) );
