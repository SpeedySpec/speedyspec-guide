<?php
// A redirect target from a request is checked: same-site URLs pass, others fall back to a URL you choose.
$fallback = admin_url( 'options-general.php' );
return array(
	'same site' => wp_validate_redirect( 'http://example.org/wp-admin/edit.php', $fallback ),
	'off site'  => wp_validate_redirect( 'https://attacker.example/steal', $fallback ),
);
