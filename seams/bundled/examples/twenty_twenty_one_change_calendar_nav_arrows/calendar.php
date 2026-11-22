<?php
// Swaps the calendar's « and » navigation arrows for SVG arrows (mirrored for right-to-left); on get_calendar.
guide_theme( 'twentytwentyone' );
return (fn( $s ) => preg_replace( '/<path.*<\/svg>/s', '…</svg>', $s ))( twenty_twenty_one_change_calendar_nav_arrows( '<a>&laquo; Feb</a>' ) );
