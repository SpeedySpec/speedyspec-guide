<?php
// Exports a user's data by email: the user fields, contact methods, community events location and session tokens, as name and value pairs; an unknown email gives no data.
$export = wp_user_personal_data_exporter( 'admin@example.org' );
$fields = wp_list_pluck( $export['data'][0]['data'], 'value', 'name' );
return array( $export['done'], $export['data'][0]['group_id'], $fields['User Login Name'], $fields['User Email'], wp_user_personal_data_exporter( 'nobody@example.org' )['data'] );
