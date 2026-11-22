<?php
// The MIME type for a file name's extension; unknown ones are application/octet-stream.
use PHPMailer\PHPMailer\PHPMailer;
return array( PHPMailer::filenameToType( 'photo.JPG' ), PHPMailer::filenameToType( 'doc.pdf?x=1' ), PHPMailer::filenameToType( 'x.unknownext' ) );
