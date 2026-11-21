import { describe, expect, test } from 'bun:test';
import { InvalidVersion, Version } from '../src/index.ts';

describe('Version', () => {
  test('a four-part version sorts after its three-part prefix', () => {
    expect(Version.parse('1.5.1.2').compare(Version.parse('1.5.1'))).toBe(1);
  });
  test('parts compare as numbers, not text', () => {
    expect(Version.parse('7.1.5').compare(Version.parse('7.10.0'))).toBe(-1);
  });
  test('equal versions compare as 0 and print as given', () => {
    expect(Version.parse('7.1.5').compare(Version.parse('7.1.5'))).toBe(0);
    expect(Version.parse('7.1.5').toString()).toBe('7.1.5');
  });
  test('unreleased sorts after every release', () => {
    expect(Version.parse('unreleased')).toBe(Version.UNRELEASED);
    expect(Version.UNRELEASED.compare(Version.parse('99.0'))).toBe(1);
  });
  test('a pre-release is not a version', () => {
    expect(() => Version.parse('7.1-beta1')).toThrow(InvalidVersion);
  });
});
