<?php
// OAuth builds the XOAUTH2 string from a league/oauth2-client provider, which WordPress doesn't bundle; any object with getOauth64() can stand in.
return interface_exists( PHPMailer\PHPMailer\OAuthTokenProvider::class ) && in_array( PHPMailer\PHPMailer\OAuthTokenProvider::class, class_implements( PHPMailer\PHPMailer\OAuth::class ), true );
