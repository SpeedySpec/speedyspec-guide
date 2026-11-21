<?php

declare(strict_types=1);

/**
 * The shared basic setup, plus an English site with French translations installed, as `wp-settings.php` sets it up.
 *
 *  `l10n.php` is loaded, so the translation functions are WordPress's own. With no database, the options the locale
 *  functions read come from filters: the site language (`WPLANG`) is English; reading any other option throws, naming
 *  it. `WP_LANG_DIR` is a fresh folder holding `fr_FR.mo` for the default text domain and `plugins/guide-fr_FR.mo` for
 *  the `guide` plugin, each translating "Hello" to "Bonjour" and "%d item"/"%d items" to "%d élément"/"%d éléments".
 *  The locale object, the locale switcher and the text domain registry are set up as on `init`.
 */

require __DIR__ . '/../basic-setup.php';

foreach ([
    'WPLANG' => '',
    'home' => 'http://example.org',
    'siteurl' => 'http://example.org',
    'template' => '',
    'stylesheet' => '',
] as $guide_name => $guide_value)
{
    add_filter("pre_option_{$guide_name}", static fn () => $guide_value);
}
// Any other option would be read from the database; say which instead of failing on a missing $wpdb.
add_filter('pre_option', static function ($pre, $name) { if (false === $pre) { throw new RuntimeException('unanswered option ' . $name); } return $pre; }, 99, 2);

$guide_lang = sys_get_temp_dir() . '/guide-languages-' . getmypid();
foreach (['WP_LANG_DIR' => $guide_lang, 'WP_CONTENT_DIR' => ABSPATH . 'wp-content', 'WP_PLUGIN_DIR' => ABSPATH . 'wp-content/plugins', 'WPMU_PLUGIN_DIR' => ABSPATH . 'wp-content/mu-plugins', 'WP_CONTENT_URL' => 'http://example.org/wp-content', 'WP_PLUGIN_URL' => 'http://example.org/wp-content/plugins', 'WPMU_PLUGIN_URL' => 'http://example.org/wp-content/mu-plugins'] as $guide_name => $guide_value)
{
    defined($guide_name) || define($guide_name, $guide_value);
}
@mkdir(WP_LANG_DIR . '/plugins', 0777, true);

/** Writes a French .mo file translating "Hello" and "%d item". */
function guide_french_mo(string $file, string $hello = 'Bonjour'): void
{
    $mo = new MO();
    $mo->set_header('Language', 'fr_FR');
    $mo->set_header('Plural-Forms', 'nplurals=2; plural=n>1;');
    $mo->add_entry(new Translation_Entry(['singular' => 'Hello', 'translations' => [$hello]]));
    $mo->add_entry(new Translation_Entry(['singular' => 'Post', 'context' => 'verb', 'translations' => ['Publier']]));
    $mo->add_entry(new Translation_Entry(['singular' => '%d item', 'plural' => '%d items', 'translations' => ['%d élément', '%d éléments']]));
    $mo->export_to_file($file);
}
guide_french_mo(WP_LANG_DIR . '/fr_FR.mo');
guide_french_mo(WP_LANG_DIR . '/plugins/guide-fr_FR.mo', 'Salut');

$GLOBALS['wp_textdomain_registry'] = new WP_Textdomain_Registry();
$GLOBALS['wp_textdomain_registry']->init();
$GLOBALS['wp_locale'] = new WP_Locale();
$GLOBALS['wp_locale_switcher'] = new WP_Locale_Switcher();
$GLOBALS['wp_locale_switcher']->init();

register_shutdown_function(static function () use ($guide_lang): void {
    foreach (glob($guide_lang . '/{,plugins/}*.mo', GLOB_BRACE) ?: [] as $file)
    {
        unlink($file);
    }
    @rmdir($guide_lang . '/plugins');
    @rmdir($guide_lang);
});
unset($guide_name, $guide_value, $guide_lang);
