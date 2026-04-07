// @ts-check
/** @import {Question, Trivia} from '../../types.d.ts' */
import { bindAllWithPrefix } from './binding.js';
import { XSlideContainer } from './slides.js';

/* Mutable globals */
/** @type {Trivia | null} */
let triviaQuestions = null;
/** @type {string | null} */
let chosenCategory = null;
let trackedAnswers = { wrong: 0, right: 0, notAnswered: 0 };

const ui = {
  slide: /** @type {XSlideContainer} */(document.getElementById('ui-slide-container')),
  slides: bindAllWithPrefix('ui-', /**@type{const}*/(['pick-category', 'load-interstitial', 'questions', 'final-result'])),
  questions: bindAllWithPrefix('ui-questions-', /** @type {const} */(['marker', 'timer', 'questions'])),
  finalResult: bindAllWithPrefix('ui-final-result-', /** @type {const} */(['correct-answers', 'wrong-answers', 'unknown-answers'])),
  other: bindAllWithPrefix('ui-', /** @type {const} */(['load-interstitial-message', 'pick-category-container'])),
};

ui.slide.setAnimation('none');

ui.slides.loadInterstitial.addEventListener('after-enter', async () => {
  try {
    const response = await fetch('/data/trivia_240_preguntas.json');
    const json = await response.json();
    triviaQuestions = json;
  } catch {
    ui.other.loadInterstitialMessage.textContent = 'No se pudieron cargar los datos';
    return;
  }
  ui.slide.next();
});

ui.slides.pickCategory.addEventListener('before-enter', () => {
  const categories = /**@type{Array<string>}*/(triviaQuestions?.categorias.map(c => c.nombre));
  ui.other.pickCategoryContainer.replaceChildren(
    ...categories.map(cat => {
      const elem = document.createElement('button');
      elem.type = 'button';
      elem.classList.add('ui-pick-category-button');
      elem.textContent = cat;
      elem.addEventListener('click', () => {
        chosenCategory = cat;
        ui.slide.next();
      });
      return elem;
    })
  );
});

ui.slides.questions.addEventListener('before-enter', () => {
  function nextQuestion() {
    if (ui.questions.questions._currentIndex === 4) {
      ui.slide.next();
      clearInterval(timerHandlerID);
    } else {
      ui.questions.questions.next();
    }
  }

  let timer = { active: true, count: 5 };
  const timerHandlerID = setInterval(() => {
    if (!timer.active) {
      return;
    }
    if (timer.count === 0) {
      trackedAnswers.notAnswered += 1;
      nextQuestion();
      return;
    }
    ui.questions.timer.textContent = `${timer.count} segundos restantes`;
    timer.count--;
  }, 1000);

  /** @type {Question[]} */
  const questions = nRandomItems(triviaQuestions?.categorias.find(c => c.nombre === chosenCategory)?.preguntas, 5);
  ui.questions.questions.replaceChildren(
    ...questions.map((q, ix) => {
      const elem = document.createElement('x-slide');
      elem.classList.add('question');
      elem.addEventListener('after-enter', () => {
        ui.questions.marker.textContent = `Pregunta ${ix + 1} de 5`;
        timer.count = 5;
        timer.active = true;
      });

      const text = document.createElement('p');
      text.classList.add('question-text');
      text.textContent = q.pregunta;

      const difficulty = document.createElement('p');
      difficulty.classList.add('question-difficulty');
      difficulty.textContent = {
        facil: 'Fácil',
        medio: 'Medio',
        dificil: 'Difícil',
      }[q.nivel];

      const possibleAnswers = [q.correcta, ...q.incorrectas];
      const answers = document.createElement('div');
      answers.classList.add('question-answers');
      answers.replaceChildren(
        ...nRandomItems(possibleAnswers, possibleAnswers.length).map(ans => {
          const btn = document.createElement('button');
          btn.type = 'button';
          btn.textContent = ans;
          btn.addEventListener('click', () => {
            timer.active = false;
            for (const node of answers.childNodes) {
              node.disabled = true;
            }
            if (q.correcta === ans) {
              trackedAnswers.right += 1;
              btn.classList.add('questions-correct-answer');
            } else {
              trackedAnswers.wrong += 1;
              btn.classList.add('questions-wrong-answer');
            }
            setTimeout(() => {
              btn.classList.remove('questions-correct-answer', 'questions-wrong-answer');
              nextQuestion();
            }, 1000);
          });
          return btn;
        })
      );

      elem.replaceChildren(text, answers, difficulty);
      return elem;
    }),
  );
  ui.questions.questions.setAnimation('none');
  ui.questions.questions.goto(0);
});

ui.slides.finalResult.addEventListener('before-enter', () => {
  ui.finalResult.correctAnswers.textContent = trackedAnswers.right.toString();
  ui.finalResult.wrongAnswers.textContent = trackedAnswers.wrong.toString();
  ui.finalResult.unknownAnswers.textContent = trackedAnswers.notAnswered.toString();
});

function nRandomItems(arr, n) {
  const indices = new Set();
  while (indices.size < n) {
    indices.add(Math.round(Math.random() * (arr.length - 1)));
  }
  return Array.from(indices).map(ix => arr[ix]);
}
