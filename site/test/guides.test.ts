import { beforeAll, describe, expect, test } from 'bun:test';
import { fixtureSite } from './fixture-build.ts';
import { html } from './helpers.ts';

let dist = '';
beforeAll(() => {
  dist = fixtureSite();
}, 240_000);

describe('the developer guides', () => {
  test('test_home_leads_with_guides', async () => {
    const home = await html(dist, '/');
    const h2 = home.text('h2');
    expect(h2[0]).toBe('Guides');
    expect(h2).toContain('Reference');
    expect(h2.indexOf('Reference')).toBeGreaterThan(0);
    expect(home.text('.home-path a')).toEqual(['First', 'Second']);
    expect(home.attr('.home-guides a', 'href')).toContain('/guides/');
    expect(home.attr('.home-reference a', 'href')).toEqual(expect.arrayContaining(['/wordpress/', '/speedyspec/']));
    expect(home.count('dl.legend')).toBe(1);
    expect(home.attr('.porting-links a', 'href')).toContain('/speedyspec/porting/hooks/');
  });

  test('test_index_lists_tracks', async () => {
    const p = await html(dist, '/guides/');
    expect(p.text('.guide-path a')).toEqual(['First', 'Second']);
    expect(p.text('.guide-topics a')).toEqual(['Hooks', 'Options']);
    expect(p.text('.guide-contributing-wordpress a')).toEqual(['Changing a function']);
    expect(p.text('h2')).toEqual(['Learning path', 'Topics', 'Contributing']);
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
