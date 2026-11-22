<?php
// Removes a protocol that isn't in the allowed list, however it is disguised.
$p = array( 'http', 'https' );
return array( wp_kses_bad_protocol( 'javascript:alert(1)', $p ), wp_kses_bad_protocol( 'JaVaScRiPt:alert(1)', $p ), wp_kses_bad_protocol( 'https://ok', $p ) );
