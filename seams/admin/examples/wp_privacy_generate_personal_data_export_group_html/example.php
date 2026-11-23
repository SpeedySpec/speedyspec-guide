<?php
// The HTML table of one group of exported personal data, such as user profile or comments, for the export file.
$html = wp_privacy_generate_personal_data_export_group_html( array( 'group_label' => 'User', 'items' => array( 'user-1' => array( array( 'name' => 'Email', 'value' => 'ada@example.org' ) ) ) ), 'user', 1 );
return array( str_contains( $html, '<h2' ), str_contains( $html, 'ada@example.org' ) );
