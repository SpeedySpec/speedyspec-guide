<?php
// Escapes for XML, leaving CDATA sections as they are.
return esc_xml( 'a < b <![CDATA[ <raw> ]]> & c' );
