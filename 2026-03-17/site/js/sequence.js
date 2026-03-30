// @ts-check
/** @import { SequenceDisplayOptions, SequenceGenerationOptions } from '../../types.d.ts' */

/** @type {(sequence: Array<number>) => number} */
export const sequenceSum = (sequence) => sequence.reduce((prev, cur) => prev + cur, 0);

/** @type {(options: SequenceGenerationOptions) => Array<number>} */
export function generateSequence(options) {
  const RANGE_EXPANSION = 20;
  const RANGE_OFFSET = Math.floor(RANGE_EXPANSION / 4);
  const stepHelper = () => Math.round(Math.random() * RANGE_EXPANSION - RANGE_OFFSET);
  const step = () => options.allowNegatives ? stepHelper() : Math.abs(stepHelper());
  /** @type {Array<number>} */
  let sequence = [];
  let previousGeneratedNumber = 0;
  for (let i = 0; i < options.numberAmount - 1; i++) {
    let num = step();
    if (num === previousGeneratedNumber) {
      num += 1;
    }
    previousGeneratedNumber = num;
    sequence.push(num);
  }

  // Ensure final sum is >= 0
  const prevSum = sequenceSum(sequence);
  if (prevSum < 0) {
    // The final value "corrects" the whole sum and forces it to be equal to `targetValue` (always >= 0)
    const targetValue = step() + RANGE_OFFSET;
    sequence.push(targetValue - prevSum);
  } else {
    // As usual, though forcing positive values
    sequence.push(Math.abs(step()));
  }
  return sequence;
}

/** @param {Array<number>} sequence
  * @param {SequenceDisplayOptions} options
  * @param {(n: number) => void} displayEff
  * @param {() => void} finishEff
  * @returns {void} */
export function handleSequenceDisplay(sequence, options, displayEff, finishEff) {
  let sequenceItemIx = 0;

  const step = () => {
    displayEff(sequenceItemIx);
    sequenceItemIx++;
  }

  step();
  const intervalId = setInterval(() => {
    if (sequenceItemIx >= sequence.length) {
      clearInterval(intervalId);
      finishEff();
      return;
    }
    step();
  }, options.transitionDelay * 1000);
}
