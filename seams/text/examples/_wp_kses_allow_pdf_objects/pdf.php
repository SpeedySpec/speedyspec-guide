<?php
// The object element is allowed only for a .pdf in the uploads folder; a URL with a query or fragment, or another extension, is refused before the uploads URL is looked up.
return array( _wp_kses_allow_pdf_objects( 'https://example.org/x.pdf?download=1' ), _wp_kses_allow_pdf_objects( 'https://example.org/x.png' ) );
