import { beforeAll, describe, expect, test } from 'bun:test';
import { fixtureSite } from './fixture-build.ts';
import { html } from './helpers.ts';

let dist = '';
beforeAll(() => {
  dist = fixtureSite();
}, 240_000);

describe('the developer guides', () => {
  test('test_home_shows_four_goal_cards', async () => {
    const home = await html(dist, '/');
    expect(home.attr('.home-cards a', 'href')).toEqual(['/guides/path/first/', '/install/', '/wordpress/', '/guides/#contributing']);
    expect(home.text('.home-cards h2')).toEqual(['Write my first plugin', 'Run SpeedySpec', 'Look up a function', 'Port or contribute']);
  });

  test('test_home_has_no_sidebar_and_is_not_indexed', async () => {
    const home = await html(dist, '/');
    expect(home.count('#starlight__sidebar')).toBe(0);
    expect(home.count('[data-pagefind-body]')).toBe(0);
    expect(home.text('h1')).toEqual(['SpeedySpec Guide']);
  });

  test('test_home_links_popular_guides', async () => {
    const home = await html(dist, '/');
    expect(home.attr('.home-popular a', 'href')).toEqual(['/guides/topics/hooks/', '/guides/topics/options/']);
  });

  test('test_header_links_stay_visible_without_a_sidebar', async () => {
    // A page without a sidebar has no mobile menu, so its header keeps the section links on narrow screens too.
    const home = await html(dist, '/');
    expect(home.attr('.site-links a', 'href')).toEqual(['/guides/', '/reference/', '/install/']);
    expect(home.count('.site-links.always')).toBe(1);
    expect(home.count('.mobile-site-links')).toBe(0);
  });

  test('test_reference_landing_links_the_references', async () => {
    const p = await html(dist, '/reference/');
    expect(p.attr('.reference-list a', 'href')).toEqual(['/wordpress/', '/speedyspec/', '/coverage/']);
    expect(p.attr('#starlight__sidebar a', 'href')).toEqual(expect.arrayContaining(['/reference/', '/wordpress/', '/coverage/']));
  });

  test('test_speedyspec_index_has_verdict_legend_and_porting_links', async () => {
    const p = await html(dist, '/speedyspec/');
    expect(p.count('dl.legend dt')).toBe(6);
    expect(p.attr('.porting-links a', 'href')).toContain('/speedyspec/porting/hooks/');
  });

  test('test_index_lists_tracks', async () => {
    const p = await html(dist, '/guides/');
    expect(p.text('.guide-path a')).toEqual(['First', 'Second']);
    expect(p.text('.guide-topics a')).toEqual(['Hooks', 'Options']);
    expect(p.text('.guide-contributing-wordpress a')).toEqual(['Changing a function']);
    expect(p.text('h2')).toEqual(['Learning path', 'Topics', 'Contributing']);
  });

  test('test_index_says_when_a_track_is_empty', async () => {
    const p = await html(dist, '/guides/');
    expect(p.count('.guide-contributing-speedyspec')).toBe(0);
    expect(p.text('.guide-empty')).toEqual(['No guides for contributing to SpeedySpec yet.']);
  });

  test('test_path_orders_by_number_then_slug', async () => {
    const first = await html(dist, '/guides/path/first/');
    expect(first.attr('.guide-next a', 'href')).toEqual(['/guides/path/second/']);
    expect(first.count('.guide-prev a')).toBe(0);
    const second = await html(dist, '/guides/path/second/');
    expect(second.attr('.guide-prev a', 'href')).toEqual(['/guides/path/first/']);
  });

  test('test_embed_renders_code_and_result', async () => {
    const p = await html(dist, '/guides/path/second/');
    expect(p.text('.guide-example pre code')[0]).toContain('add_filter');
    expect(p.text('.guide-example .result-return')).toEqual(['20']);
    expect(p.count('.guide-example .ran-passed')).toBe(2);
  });

  test('test_embed_shows_failed_status', async () => {
    const p = await html(dist, '/guides/path/first/');
    expect(p.count('.guide-example .ran-failed')).toBe(1);
    expect(p.text('.guide-example .result-output')).toEqual(['Hello']);
  });

  test('test_embed_shows_its_explanation', async () => {
    const p = await html(dist, '/guides/path/first/');
    expect(p.text('.guide-example .example-title')).toEqual(["A plugin's first hook."]);
  });

  test('test_sym_links_nested_pages', async () => {
    const p = await html(dist, '/guides/path/first/');
    expect(p.attr('a.sym', 'href')).toEqual(['/wordpress/hooks/filter/the_content/']);
  });

  test('test_speedyspec_note_shows_verdict', async () => {
    const p = await html(dist, '/guides/path/second/');
    expect(p.count('.speedyspec-note .verdict')).toBe(1);
  });

  test('test_topic_links_reference_and_back', async () => {
    const topic = await html(dist, '/guides/topics/hooks/');
    expect(topic.attr('.guide-reference a', 'href')).toContain('/wordpress/hooks/');
    const seam = await html(dist, '/wordpress/hooks/');
    expect(seam.attr('.seam-guide a', 'href')).toEqual(['/guides/topics/hooks/']);
  });

  test('test_topic_for_undocumented_seam_builds', async () => {
    const topic = await html(dist, '/guides/topics/options/');
    expect(topic.text('h1')).toEqual(['Options']);
    expect(topic.attr('.guide-reference a', 'href')).toContain('/wordpress/options/');
  });

  test('test_contributing_page_renders', async () => {
    const p = await html(dist, '/guides/contributing/wordpress/change/');
    expect(p.text('h1')).toEqual(['Changing a function']);
  });
});
