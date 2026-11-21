<?php
// A translation is made to begin and end with newlines when its original does.
return array( PO::match_begin_and_end_newlines( 'Bonjour', "\nHello\n" ), PO::match_begin_and_end_newlines( "\nBonjour\n", 'Hello' ) );
