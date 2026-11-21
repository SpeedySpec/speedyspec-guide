<?php
// Removes line breaks from a header value.
return ( new PHPMailer\PHPMailer\PHPMailer() )->secureHeader( "a\r\nb" );
