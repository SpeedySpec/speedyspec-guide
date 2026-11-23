<?php
// Hooked to the daily cron: deletes draft menu items that were added but never saved, once they are older than EMPTY_TRASH_DAYS (30 days by default).
$old = wp_update_nav_menu_item( 0, 0, array( 'menu-item-title' => 'Docs', 'menu-item-url' => 'https://example.org/docs', 'menu-item-status' => 'draft' ) );
update_post_meta( $old, '_menu_item_orphaned', time() - 60 * DAY_IN_SECONDS );
$new = wp_update_nav_menu_item( 0, 0, array( 'menu-item-title' => 'Blog', 'menu-item-url' => 'https://example.org/blog', 'menu-item-status' => 'draft' ) );
update_post_meta( $new, '_menu_item_orphaned', time() );
_wp_delete_orphaned_draft_menu_items();
return array( get_post( $old ), get_post_status( $new ) );
