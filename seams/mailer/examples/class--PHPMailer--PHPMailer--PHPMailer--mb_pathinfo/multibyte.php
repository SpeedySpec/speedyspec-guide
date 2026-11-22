<?php
// pathinfo() that keeps multibyte file names intact.
return PHPMailer\PHPMailer\PHPMailer::mb_pathinfo( '/files/résumé.pdf' );
