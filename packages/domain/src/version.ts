/** Thrown when text is not a dotted numeric version or `unreleased`. */
export class InvalidVersion extends Error {
  constructor(text: string) {
    super(`not a version: ${JSON.stringify(text)}`);
    this.name = 'InvalidVersion';
  }
}

/** A release version: dotted numbers of any length (`1.5.1.2`, `7.1.5`), or `unreleased`. Value Object. */
export class Version {
  static readonly UNRELEASED: Version = new Version([], 'unreleased');

  private constructor(private readonly parts: readonly number[], private readonly text: string) {}

  static parse(text: string): Version {
    if (text === 'unreleased') return Version.UNRELEASED;
    if (!/^\d+(\.\d+)*$/.test(text)) throw new InvalidVersion(text);
    return new Version(text.split('.').map(Number), text);
  }

  static isRelease(text: string): boolean {
    return /^\d+(\.\d+)+$/.test(text);
  }

  compare(other: Version): -1 | 0 | 1 {
    if (this === other) return 0;
    if (this === Version.UNRELEASED) return 1;
    if (other === Version.UNRELEASED) return -1;
    const n = Math.max(this.parts.length, other.parts.length);
    for (let i = 0; i < n; i++) {
      const a = this.parts[i];
      const b = other.parts[i];
      if (a === undefined) return -1;
      if (b === undefined) return 1;
      if (a !== b) return a < b ? -1 : 1;
    }
    return 0;
  }

  toString(): string {
    return this.text;
  }
}
