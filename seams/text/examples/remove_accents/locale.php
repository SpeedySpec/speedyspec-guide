<?php
// Some locales have their own rules: in German, ü becomes ue.
return array( remove_accents( 'Müller', 'de_DE' ), remove_accents( 'Müller', 'en_US' ) );
