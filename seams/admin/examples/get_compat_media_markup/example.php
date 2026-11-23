<?php
// The HTML of the extra attachment fields plugins add, shown in the media modal's details.
function guide_credit_field( array $fields, WP_Post $post ): array
{
	$fields['credit'] = array( 'label' => 'Credit', 'input' => 'text', 'value' => 'Ada' );
	return $fields;
}
add_filter( 'attachment_fields_to_edit', 'guide_credit_field', 10, 2 );
$id = wp_insert_attachment( array( 'post_title' => 'Lake', 'post_mime_type' => 'image/jpeg' ), '2026/11/lake.jpg' );
$markup = get_compat_media_markup( $id );
return array( str_contains( $markup['item'], 'Credit' ), str_contains( $markup['item'], 'Ada' ) );
