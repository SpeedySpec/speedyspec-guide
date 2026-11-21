<?php
// An address already in To, Cc or Bcc, compared case-insensitively, isn't added again.
$mail = new PHPMailer\PHPMailer\PHPMailer();
$mail->addAddress( 'a@example.org' );
return array( $mail->addCC( 'A@example.org' ), count( $mail->getAllRecipientAddresses() ) );
