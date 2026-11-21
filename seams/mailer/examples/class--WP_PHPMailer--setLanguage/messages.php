<?php
// Sets the error messages from WordPress's translations, whatever language is asked for.
WP_PHPMailer::setLanguage( 'fr' );
$language = ( new ReflectionProperty( PHPMailer\PHPMailer\PHPMailer::class, 'language' ) )->getValue();
return $language['connect_host'];
