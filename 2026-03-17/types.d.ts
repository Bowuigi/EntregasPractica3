export type PresetName = 'easy' | 'medium' | 'hard' | 'flash';
export type TransitionAnimation = string;

export type SequenceGenerationOptions = {
  numberAmount: number, // 1 minimum
  allowNegatives: boolean, // Default true
};

export type SequenceDisplayOptions = {
  transitionDelay: number, // In seconds, 1s minimum
  transitionAnimation: TransitionAnimation,
};

export type Options = {
  initialPreset: PresetName,
  generation: SequenceGenerationOptions,
  display: SequenceDisplayOptions,
}

export type AppState = {
  currentRound: {
    startTimestamp: number,
    options: Options,
    expectedSum: number,
    guessedSum: number,
  },
  sequence: Array<number>,
  previousRounds: Array<{ score: number, elapsedTime: string, expectedSum: number, guessedSum: number }>;
};
