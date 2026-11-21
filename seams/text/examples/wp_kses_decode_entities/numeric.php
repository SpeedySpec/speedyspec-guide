<?php
// Decodes numeric entities only.
return wp_kses_decode_entities( '&#65;&#x42; &amp;' );
