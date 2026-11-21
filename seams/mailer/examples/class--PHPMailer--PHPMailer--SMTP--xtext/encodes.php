<?php
// Encodes a value as SMTP xtext: + and anything outside printable ASCII become +XX.
return PHPMailer\PHPMailer\SMTP::xtext( 'a+b c' );
