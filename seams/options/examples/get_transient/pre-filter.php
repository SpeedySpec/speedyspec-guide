<?php
// A value other than false from pre_transient_{$transient} is returned without reading the transient.
add_filter( 'pre_transient_guide_t', fn() => 'from the filter' );
return get_transient( 'guide_t' );
