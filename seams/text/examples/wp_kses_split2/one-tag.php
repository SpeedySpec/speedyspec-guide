<?php
// Filters one tag: an allowed one keeps its allowed attributes, others are removed.
$protocols = wp_allowed_protocols();
return array( wp_kses_split2( '<em class="x">', array( 'em' => array() ), $protocols ), wp_kses_split2( '<u>', array( 'em' => array() ), $protocols ) );
