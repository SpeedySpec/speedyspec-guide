<?php
// Decodes RFC 2047 encoded words.
return PHPMailer\PHPMailer\PHPMailer::decodeHeader( '=?utf-8?Q?Caf=C3=A9?=', 'utf-8' );
