<?php
// In the xml context, HTML's named entities that XML lacks become their characters.
return wp_kses_normalize_entities( '&copy; &amp;', 'xml' );
