<?php
// Makes every line break the same, CRLF by default for SMTP.
return bin2hex( PHPMailer\PHPMailer\PHPMailer::normalizeBreaks( "a\nb\rc\r\n" ) );
