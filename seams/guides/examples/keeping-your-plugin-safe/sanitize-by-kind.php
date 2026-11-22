<?php
// Each kind of value has its own sanitizer; pick the one that matches what the field should hold.
return array(
	'text'  => sanitize_text_field( "  Hello <script>alert(1)</script><b>world</b>\n " ),
	'email' => sanitize_email( ' ana(at)@example.org<> ' ),
	'key'   => sanitize_key( 'My Setting-Name!' ),
	'count' => absint( '-12 apples' ),
);
