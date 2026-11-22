<?php
// Keeps a user name safe: accents and tags removed, entities dropped; with $strict, only letters, digits and _ . - @ and space.
return array( sanitize_user( 'Ada<b> Lövelace!' ), sanitize_user( 'Ada<b> Lövelace!', true ) );
