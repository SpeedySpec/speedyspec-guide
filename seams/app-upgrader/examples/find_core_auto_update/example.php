<?php
// The core update automatic updates would install now, given the auto-update settings, or false.
guide_offer_core_update( '7.3' );
$update = find_core_auto_update();
return false === $update ? false : $update->current;
