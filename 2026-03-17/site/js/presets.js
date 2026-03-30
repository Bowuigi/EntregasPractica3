// @ts-check
/** @import {Options} from '../../types.d.ts' */

/** @type {Options} */
const easyPreset = {
  initialPreset: 'easy',
  generation: {
    numberAmount: 3,
    allowNegatives: false,
  },
  display: {
    transitionDelay: 3,
    transitionAnimation: 'none',
  },
};

/** @type {Options} */
export const mediumPreset = {
  initialPreset: 'medium',
  generation: {
    numberAmount: 5,
    allowNegatives: true,
  },
  display: {
    transitionDelay: 2.5,
    transitionAnimation: 'none',
  },
};

/** @type {Options} */
const hardPreset = {
  initialPreset: 'hard',
  generation: {
    numberAmount: 7,
    allowNegatives: true,
  },
  display: {
    transitionDelay: 2,
    transitionAnimation: 'none',
  },
};

/** @type {Options} */
const flashPreset = {
  initialPreset: 'flash',
  generation: {
    numberAmount: 3,
    allowNegatives: false, // ignored on this case
  },
  display: {
    transitionDelay: 1,
    transitionAnimation: 'none',
  },
};

export const presets = {
  easy: easyPreset,
  medium: mediumPreset,
  hard: hardPreset,
  flash: flashPreset,
}
/** @typedef {keyof typeof presets} Presets */
