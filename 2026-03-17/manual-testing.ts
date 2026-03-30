// This file is only used for manually testing the various components using the `deno repl` REPL
import { generateSequence, handleSequenceDisplay, sequenceSum } from "./site/js/sequence.js";
import type { Options } from "./types.d.ts";

export function seq(options: Options, amount: number): Array<{ seq: Array<number>, sum: number }> {
  return Array.from({ length: amount }, () => {
    const seq = generateSequence(options.generation);
    return {
      seq: seq,
      sum: sequenceSum(seq),
    };
  });
}

export function seqDisplay(options: Options): void {
  const seq = generateSequence(options.generation);
  handleSequenceDisplay(seq, options.display,
    n => console.log('Display:', n),
    () => console.log('Finish'),
  );
}

