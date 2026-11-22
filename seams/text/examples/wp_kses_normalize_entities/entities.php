<?php
// Escapes & that doesn't start a valid entity, keeps valid ones, and pads decimal entities to three digits.
return wp_kses_normalize_entities( 'a & b &amp; &copy; &bogus; &#65;' );
