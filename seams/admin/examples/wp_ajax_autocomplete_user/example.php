<?php
// Ajax handler for user autocomplete on a network: sends the users matching the typed text as JSON; refuses on single sites.
return guide_ajax( 'wp_ajax_autocomplete_user', array( 'term' => 'ad' ) );
