export type KebabToCamelCase<S> =
  S extends `${infer A}-${infer B}`
  ? `${A}${Capitalize<KebabToCamelCase<B>>}`
  : S;

export type CamelToKebabCase<S extends string> = 
  S extends `${infer First}${infer Rest}`
    ? First extends Lowercase<First>
      ? `${First}${CamelToKebabCase<Rest>}`
      : `-${Lowercase<First>}${CamelToKebabCase<Rest>}`
    : S;

export function toCamelCase<S extends string>(str: S): KebabToCamelCase<S>;
export function fromCamelCase<S extends string>(str: S): CamelToKebabCase<S>;
export function bindAll<T extends ReadonlyArray<string>>(template: T): { [K in T[number] as KebabToCamelCase<K>]: HTMLElement };
export function bindAllWithPrefix<T extends ReadonlyArray<string>>(prefix: string, template: T): { [K in T[number] as KebabToCamelCase<K>]: HTMLElement };
export function bindAllWithSuffix<T extends ReadonlyArray<string>>(suffix: string, template: T): { [K in T[number] as KebabToCamelCase<K>]: HTMLElement };
