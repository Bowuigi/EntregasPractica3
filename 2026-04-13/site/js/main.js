import { emojis } from './emojis.js';

function nRandomItems(arr, n) {
  const indices = new Set();
  while (indices.size < n) {
    indices.add(Math.round(Math.random() * (arr.length - 1)));
  }
  return Array.from(indices).map(ix => arr[ix]);
}

class MemoCell extends HTMLElement {
  #emoji = 'X';
  #state = 'down';
  #emojiElem = null;
  constructor() {
    super();
    this.#emojiElem = document.createElement('button');
    const shadow = this.attachShadow({ mode: 'open' }).replaceChildren(this.#emojiElem);
    this.#emojiElem.style.width = '3rem';
    this.#emojiElem.style.height = '3rem';
    this.#emojiElem.style.fontSize = '1.5rem';
  }
  get state() {
    return this.#state;
  }
  get emoji() {
    return this.#emoji;
  }
  set emoji(value) {
    this.#emoji = value;
    this.#emojiElem.textContent = value;
  }
  down() {
    this.#state = 'down';
    this.#emojiElem.textContent = '';
  }
  up() {
    this.#state = 'up';
    this.#emojiElem.textContent = this.#emoji;
  }
}
customElements.define('memo-cell', MemoCell);

class MemoContainer extends HTMLElement {
  board = [];
  shadow;
  firstClicked = null;
  score = 0;
  errors = 0;
  constructor() {
    super();
    this.shadow = this.attachShadow({ mode: 'open' })
  }
  connectedCallback() {
    const unshuffled = [...emojis, ...emojis];
    this.board = nRandomItems(unshuffled, unshuffled.length).map(val => {
      const cell = /** @type{MemoCell} */(document.createElement('memo-cell'));
      cell.emoji = val;
      cell.down();
      cell.addEventListener('click', () => {
        if (cell.state === 'up') return;
        cell.up();
        if (this.firstClicked === null) {
          this.firstClicked = cell;
          return;
        }

        if (this.firstClicked.emoji === cell.emoji) {
          this.score++;
          this.firstClicked = null;
          if (this.score === emojis.length) {
            document.getElementById('win-banner-right').textContent = `${this.score} correctas`;
            document.getElementById('win-banner-wrong').textContent = `${this.errors} errores`;
            document.getElementById('win-banner').style.display = '';
          }
        } else {
          let cachedFirstClicked = this.firstClicked;
          this.firstClicked = null;
          setTimeout(() => {
            cell.down();
            cachedFirstClicked.down();
            this.errors++;
          }, 1000);
        }
      });
      return cell;
    });
    this.shadow.replaceChildren(...this.board);

    this.style.display = 'grid';
    this.style.gridTemplateColumns = `repeat(${Math.floor(Math.sqrt(emojis.length * 2))}, min-content)`;
    this.style.gap = '2px';
  }
}
customElements.define('memo-container', MemoContainer);
