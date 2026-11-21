<?php
// Quotes a name for a header when it has special characters.
use PHPMailer\PHPMailer\PHPMailer;
return array( PHPMailer::quotedString( 'Joe' ), PHPMailer::quotedString( 'Doe, Joe' ) );
