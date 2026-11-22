<?php
// WordPress's older POP3 client, used for post-by-email. Its helpers read a server's replies. parse_banner() skips every '0' in the banner, because it tests each character with empty().
$pop = new POP3();
return array( $pop->is_ok( "+OK ready\r\n" ), $pop->is_ok( '-ERR no' ), $pop->strip_clf( "line\r\n" ), $pop->parse_banner( "+OK POP3 <1896.697170952@dbc.mtview.ca.us>\r\n" ) );
