<?php
// Trims, turns \\r into \\n, collapses runs of newlines and of spaces and tabs.
return normalize_whitespace( "  a \t b\r\n\n c  " );
