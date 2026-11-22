<?php
// Prints the hidden fields that guard the sign-up form: a random id and its nonce.
return preg_replace( '/value=([\'"])[^\'"]+\1/', 'value="X"', guide_render( 'signup_nonce_fields' ) );
