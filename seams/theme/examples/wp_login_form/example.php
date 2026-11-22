<?php
// A log in form posting to wp-login.php, with remember me and a redirect; printed unless echo is false; filtered by login_form_defaults and the login_form_* filters.
$form = wp_login_form( array( 'echo' => false, 'redirect' => home_url( '/dash' ), 'form_id' => 'my-login' ) );
return array( str_contains( $form, 'id="my-login"' ), str_contains( $form, 'name="rememberme"' ), str_contains( $form, 'value="http://example.org/dash"' ) );
