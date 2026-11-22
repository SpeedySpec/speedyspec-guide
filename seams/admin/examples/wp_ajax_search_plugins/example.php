<?php
// Ajax handler for the installed plugins search: sends the plugins list table rows matching the search as JSON.
$sent = json_decode( guide_ajax( 'wp_ajax_search_plugins', array( 's' => 'hello', 'pagenow' => 'plugins' ), 'updates' ), true );
return array( $sent['success'], str_contains( $sent['data']['items'], 'Hello Dolly' ) );
