// @ts-check
/** @import { XSlide, XSlideContainer } from './slides.js' */
/** @import { AppState } from '../../types.d.ts' */
/** @import { Presets } from './presets.js' */
import './slides.js';
import { presets } from './presets.js';
import { generateSequence, handleSequenceDisplay, sequenceSum } from './sequence.js';

/** @type {(preset: Presets | null) => void} */
function updateConfigFormData(preset) {
  const form = configSlide.querySelector('form');
  const formPreset = /**@type{HTMLSelectElement}*/( form?.querySelector('#preset') );
  const formNumberAmount = /**@type{HTMLInputElement}*/( form?.querySelector('#number-amount') );
  const formAllowNegatives = /**@type{HTMLInputElement}*/( form?.querySelector('#allow-negatives') );
  const formTransitionDelay = /**@type{HTMLInputElement}*/( form?.querySelector('#transition-delay') );
  const formAnimation = /**@type{HTMLInputElement}*/( form?.querySelector('#animation') );
  if (preset === null) {
    preset = /** @type{Presets} */( formPreset.value );
  }
  formPreset.value = preset;
  formNumberAmount.value = presets[preset].generation.numberAmount.toString();
  formAllowNegatives.checked = presets[preset].generation.allowNegatives;
  formTransitionDelay.value = presets[preset].display.transitionDelay.toString();
  formAnimation.value = presets[preset].display.transitionAnimation;
}

/** @type {AppState} */
let gameState = {
  currentRound: {
    startTimestamp: 0,
    options: presets.easy,
    expectedSum: 0,
    guessedSum: 0,
  },
  sequence: [],
  previousRounds: [],
};

const uiSlides = /**@type{XSlideContainer}*/(document.getElementById('ui-slides'));

for (const elem of document.getElementsByClassName('goto-next-btn')) {
  elem.addEventListener('click', () => { uiSlides.next() })
}

const configSlide = /**@type{XSlide}*/(document.getElementById('config-slide'));

configSlide.addEventListener('after-enter', () => {
  updateConfigFormData('easy');
});
configSlide.querySelector('form > select')?.addEventListener('change', () => { updateConfigFormData(null) });
configSlide.addEventListener('before-exit', () => {
  const form = configSlide.querySelector('form');
  const formPreset = /**@type{HTMLSelectElement}*/( form?.querySelector('#preset') );
  const formNumberAmount = /**@type{HTMLInputElement}*/( form?.querySelector('#number-amount') );
  const formAllowNegatives = /**@type{HTMLInputElement}*/( form?.querySelector('#allow-negatives') );
  const formTransitionDelay = /**@type{HTMLInputElement}*/( form?.querySelector('#transition-delay') );
  const formAnimation = /**@type{HTMLInputElement}*/( form?.querySelector('#animation') );
  gameState.currentRound.options = {
    initialPreset: /** @type {Presets} */( formPreset.value ),
    generation: {
      numberAmount: parseInt(formNumberAmount.value),
      allowNegatives: formAllowNegatives.checked,
    },
    display: {
      transitionDelay: parseFloat(formTransitionDelay.value),
      transitionAnimation: formAnimation.value,
    },
  };
  // @ts-ignore
  uiSlides.setAnimation(gameState.currentRound.options.display.transitionAnimation);
});

const sequenceSlide = /**@type{XSlide}*/(document.getElementById('sequence-slide'));
const seqSlides = /**@type{XSlideContainer}*/( document.createElement('x-slide-container') );

sequenceSlide.addEventListener('before-enter', () => {
  gameState.sequence = generateSequence(gameState.currentRound.options.generation);
  console.log(gameState.sequence);
  for (const item of gameState.sequence) {
    const slide = document.createElement('x-slide');
    const elem = document.createElement('p');
    elem.style.textAlign = 'center';
    elem.style.fontSize = '40pt';
    elem.textContent = item.toString();
    const theme = [
      {bg: 'red', fg: 'white'},
      {bg: 'blue', fg: 'white'},
      {bg: '#eeeeee', fg: 'black'},
      {bg: 'yellow', fg: 'black'},
      {bg: 'black', fg: 'white'},
      {bg: 'orange', fg: 'black'},
      {bg: 'cyan', fg: 'black'},
      {bg: 'papayawhip', fg: 'black'},
      {bg: 'purple', fg: 'white'},
      {bg: 'white', fg: 'black'},
      {bg: 'maroon', fg: 'white'},
    ][Math.round(Math.random()*10)];
    elem.style.color = theme.fg;
    slide.style.backgroundColor = theme.bg;
    slide.appendChild(elem);
    seqSlides.appendChild(slide);
  }
  seqSlides.setAnimation('none');
  sequenceSlide.appendChild(seqSlides);
  gameState.currentRound.expectedSum = sequenceSum(gameState.sequence);
});

sequenceSlide.addEventListener('after-enter', () => {
  handleSequenceDisplay(
    gameState.sequence,
    gameState.currentRound.options.display,
    n => { seqSlides.goto(n); },
    () => {
      uiSlides.next()
      Array.from(seqSlides.childNodes).forEach(n => n.remove());
      seqSlides.remove();
    },
  );
});

const inputSlide = /**@type{XSlide}*/(document.getElementById('input-slide'));

inputSlide.addEventListener('before-enter', () => {
  gameState.currentRound.startTimestamp = Date.now();
});

inputSlide.addEventListener('before-exit', () => {
  const answerElem = /**@type{HTMLInputElement}*/( document.querySelector('#answer') );
  gameState.currentRound.guessedSum = parseInt(answerElem.value);
});

const resultSlide = /**@type{XSlide}*/(document.getElementById('result-slide'));

resultSlide.addEventListener('before-enter', () => {
  const title = /**@type{HTMLElement}*/ ( document.getElementById('result-title') );
  const answer = /**@type{HTMLElement}*/ ( document.getElementById('result-correct-answer') );
  const elapsedTime = /**@type{HTMLElement}*/ ( document.getElementById('result-elapsed-time') );
  const score = /**@type{HTMLElement}*/ ( document.getElementById('result-score') );

  answer.textContent = `Respuesta correcta: ${gameState.currentRound.expectedSum.toString()}`;

  const timeDiff = Math.abs(Date.now() - gameState.currentRound.startTimestamp) / 1000;
  const minutesDiff = Math.floor(timeDiff / 60);
  const secondsDiff = Math.floor(timeDiff % 60);
  elapsedTime.textContent = `Tiempo total: ${minutesDiff}:${secondsDiff.toString().padStart(2, '0')}`;

  const roundScore = gameState.currentRound.guessedSum === gameState.currentRound.expectedSum ? Math.floor(180 - timeDiff) : 0;
  if (gameState.currentRound.guessedSum === gameState.currentRound.expectedSum) {
    title.textContent = '¡Ganaste!';
    score.textContent = `Puntuación: ${roundScore.toString()}`;
  } else {
    title.textContent = '¡Perdiste!';
    score.textContent = `Puntuación: 0`;
  }

  gameState.previousRounds.push({
    score: roundScore,
    elapsedTime: `${minutesDiff}:${secondsDiff.toString().padStart(2, '0')}`,
    expectedSum: gameState.currentRound.expectedSum,
    guessedSum: gameState.currentRound.guessedSum,
  });

  const historyTbody = /**@type{HTMLElement}*/(document.getElementById('history-tbody'));
  historyTbody.innerHTML = gameState.previousRounds
    .map(round => `<tr><td>${round.score}</td><td>${round.elapsedTime}</td><td>${round.expectedSum}</td><td>${round.guessedSum}</td></tr>`)
    .join('');
});
