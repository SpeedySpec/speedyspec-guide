<?php
// A file in a block theme's patterns folder registers itself as a pattern, from the header comment at its top.
$dir = sys_get_temp_dir() . '/guide-theme-root/my-pattern-theme';
wp_mkdir_p( "$dir/patterns" );
file_put_contents( "$dir/style.css", "/*\nTheme Name: My Pattern Theme\nTemplate: twentytwentyfive\n*/\n" );
file_put_contents(
	"$dir/patterns/book-card.php",
	<<<'PHP'
<?php
/**
 * Title: Book card
 * Slug: my-pattern-theme/book-card
 * Categories: featured
 */
?>
<!-- wp:paragraph --><p><?php echo esc_html__( 'A book worth reading.', 'my-pattern-theme' ); ?></p><!-- /wp:paragraph -->
PHP
);
register_theme_directory( dirname( $dir ) );
search_theme_directories( true );
switch_theme( 'my-pattern-theme' );

_register_theme_block_patterns(); // WordPress runs this on init for the active theme and its parent.
$pattern = WP_Block_Patterns_Registry::get_instance()->get_registered( 'my-pattern-theme/book-card' );
return array( 'title' => $pattern['title'], 'categories' => $pattern['categories'], 'content' => trim( $pattern['content'] ?? '' ) );
