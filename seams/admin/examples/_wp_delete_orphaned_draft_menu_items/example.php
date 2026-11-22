<?php
// Hooked to the daily cron: deletes draft menu items older than a week, which were added but never saved.
$item = wp_update_nav_menu_item( 0, 0, array( 'menu-item-title' => 'Docs', 'menu-item-url' => 'https://example.org/docs', 'menu-item-status' => 'draft' ) );
update_post_meta( $item, '_menu_item_orphaned', time() - 2 * WEEK_IN_SECONDS );
_wp_delete_orphaned_draft_menu_items();
return get_post( $item );
