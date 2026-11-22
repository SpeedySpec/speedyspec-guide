<?php
// Hooked to rest_pre_serve_request: allows the request's Origin with credentials and sends Vary: Origin; gives back its first argument unchanged, so serving goes on.
$_SERVER['HTTP_ORIGIN'] = 'https://app.example.com';
return array( rest_send_cors_headers( false ), rest_send_cors_headers( true ) );
