<?php
// Decodes a Q-encoded email subject, as the post-by-email feature gets it; the bytes stay in the subject's charset.
return bin2hex( wp_iso_descrambler( '=?iso-8859-1?q?Caf=E9?=' ) );
