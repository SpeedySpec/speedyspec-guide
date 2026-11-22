<?php
// A fault response with the code and the escaped message.
$error = new IXR_Error( 403, 'Bad <login>' );
return array( $error->code, $error->message, $error->getXml() );
