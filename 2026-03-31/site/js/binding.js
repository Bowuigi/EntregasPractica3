// Build a set of type-safe 'id: element' bindings automagically
// Provides autocompletion + type safety! TS is pretty nice for this stuff ngl
// The actual magic is on the corresponding .d.ts file because of JSDoc limitations

export function toCamelCase(str) {
  return str.replace(
    /-([a-z])/g,
    (_, letter) => letter.toUpperCase()
  );
}

export function fromCamelCase(str) {
  return str
    .replace(/([A-Z])/g, '-$1')
    .toLowerCase();
}

export function bindAll(template) {
  return Object.fromEntries(
    template.map(b => [toCamelCase(b), document.getElementById(b)]),
  );
}

export function bindAllWithPrefix(prefix, template) {
  return Object.fromEntries(
    template.map(b => [toCamelCase(b), document.getElementById(prefix + b)]),
  );
}

export function bindAllWithSuffix(suffix, template) {
  return Object.fromEntries(
    template.map(b => [toCamelCase(b), document.getElementById(b + suffix)]),
  );
}
