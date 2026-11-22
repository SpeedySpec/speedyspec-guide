<?php
// Sends an email through PHPMailer: to, subject, message, headers and attachments, from WordPress <wordpress@site> unless the headers or filters say otherwise; pre_wp_mail can answer instead (as here).
return wp_mail( 'ada@example.org', 'Hello', 'Body' );
