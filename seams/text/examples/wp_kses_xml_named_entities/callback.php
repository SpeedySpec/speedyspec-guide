<?php
// The callback for one named entity in XML: XML's own are kept, HTML's decoded, and others escaped.
return array( wp_kses_xml_named_entities( array( '&amp;', 'amp' ) ), wp_kses_xml_named_entities( array( '&copy;', 'copy' ) ) );
