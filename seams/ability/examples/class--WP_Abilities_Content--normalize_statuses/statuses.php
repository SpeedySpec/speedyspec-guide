<?php
// Statuses asked for are kept; otherwise publish, or, when listing IDs or slugs, every non-internal status the user may query.
register_post_status( 'publish', array( 'public' => true, 'label_count' => array( 'x', 'x' ) ) );
register_post_status( 'draft', array( 'protected' => true, 'label_count' => array( 'x', 'x' ) ) );
register_post_status( 'private', array( 'private' => true, 'label_count' => array( 'x', 'x' ) ) );
guide_core_abilities();
$content = new WP_Abilities_Content();
$type = get_post_type_object( 'guide_note' );
return array(
	guide_private( $content, 'normalize_statuses', array( 'draft' ), $type, false ),
	guide_private( $content, 'normalize_statuses', array(), $type, false ),
	guide_private( $content, 'normalize_statuses', array(), $type, true ),
	guide_private( $content, 'get_requested_statuses', array( 'status' => 'Draft,publish' ) ),
	guide_private( $content, 'can_query_status', 'draft', $type ),
);
