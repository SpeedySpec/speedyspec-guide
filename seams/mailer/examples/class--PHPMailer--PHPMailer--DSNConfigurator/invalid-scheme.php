<?php
// Only mail, sendmail, qmail, smtp and smtps are allowed.
try {
	PHPMailer\PHPMailer\DSNConfigurator::mailer( 'ftp://example.org' );
} catch ( PHPMailer\PHPMailer\Exception $e ) {
	return $e->getMessage();
}
