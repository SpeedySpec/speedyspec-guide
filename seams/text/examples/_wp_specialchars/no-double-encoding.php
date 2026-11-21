<?php
// Escapes < > & and, by default, no quotes; existing entities are left alone.
return array( _wp_specialchars( 'a < b & "c" &amp;' ), _wp_specialchars( '"c" \'d\'', ENT_QUOTES ) );
