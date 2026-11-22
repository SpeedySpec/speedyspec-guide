<?php
// Deprecated in 2.8.0; use _n_noop(). Register plural strings in POT file, but don't translate them. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( '__ngettext_noop', 'item', 'items' );
