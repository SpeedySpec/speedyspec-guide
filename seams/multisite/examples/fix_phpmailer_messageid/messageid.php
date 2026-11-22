<?php
// Sets the Message-ID host of outgoing mail to the network's domain; on phpmailer_init.
$mailer = (object) array( 'Hostname' => '' );
fix_phpmailer_messageid( $mailer );
return $mailer->Hostname;
