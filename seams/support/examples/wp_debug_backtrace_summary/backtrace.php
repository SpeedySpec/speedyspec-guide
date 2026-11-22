<?php
// The call stack as a comma-separated list of functions and methods, outer first (or as an array, innermost first), skipping some frames and file includes.
function guide_outer() { return guide_inner(); }
function guide_inner() { return wp_debug_backtrace_summary( null, 0, false ); }
return array_values( array_filter( guide_outer(), fn( $call ) => str_starts_with( $call, 'guide_' ) ) );
