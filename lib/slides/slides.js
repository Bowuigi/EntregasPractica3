// @ts-check

export class XSlide extends HTMLElement {
  constructor() {
    super();
    this.attachShadow({ mode: 'open' }).innerHTML = `<slot></slot>`;
  }
}

export class XSlideContainer extends HTMLElement {
  _currentIndex = 0;
  _animation = 'fade';
  _isTransitioning = false;
  _initialized = false;

  constructor() { super(); }

  /** @returns {XSlide[]} */
  get slides() {
    return Array.from(this.querySelectorAll(':scope > x-slide'));
  }

  connectedCallback() {
    if (this._initialized) return;

    const initOnReady = () => {
      // Small delay to ensure any user-defined scripts have run
      setTimeout(() => this._init(), 10);
    };

    if (document.readyState === 'loading') {
      window.addEventListener('DOMContentLoaded', initOnReady);
    } else {
      initOnReady();
    }
  }

  async _init() {
    if (this._initialized) return;
    const slides = this.slides;
    if (slides.length > 0) {
      slides.forEach((s, i) => {
        if (i === 0) {
          s.setAttribute('active', '');
        } else {
          s.removeAttribute('active');
        }
      });

      // Initial slide callbacks
      slides[0].dispatchEvent(new CustomEvent('before-enter'));
      slides[0].dispatchEvent(new CustomEvent('after-enter'));
    }
    this._initialized = true;
  }

  /** @type {(anim: 'none' | 'fade' | 'grow' | 'shrink') => void} */
  setAnimation(anim) { this._animation = anim; }

  async next() {
    if (this.slides.length === 0) return;
    await this.goto((this._currentIndex + 1) % this.slides.length);
  }
  async prev() {
    if (this.slides.length === 0) return;
    await this.goto((this._currentIndex - 1 + this.slides.length) % this.slides.length);
  }

  /** @type {(idx: number) => Promise<void>} */
  async goto(idx) {
    if (this._isTransitioning) return;
    if (idx < 0 || idx >= this.slides.length) return;

    const from = this.slides[this._currentIndex];
    const to = this.slides[idx];

    if (!from || !to || !this._initialized) return;

    this._isTransitioning = true;
    from.dispatchEvent(new CustomEvent('before-exit'));
    to.dispatchEvent(new CustomEvent('before-enter'));

    if (this._animation === 'none') {
      from.removeAttribute('active');
      to.setAttribute('active', '');
    } else {
      await this._animate(from, to);
    }

    this._currentIndex = idx;
    this._isTransitioning = false;

    to.dispatchEvent(new CustomEvent('after-enter'));
  }

   /** @type {(from: XSlide, to: XSlide) => Promise<void>} */
  async _animate(from, to) {
    return new Promise(/** @type {() => void} */ resolve => {
      const name = this._animation;
      const outC = `xs-animate-${name}-out`;
      const inC = `xs-animate-${name}-in`;

      to.setAttribute('active', '');
      from.classList.add(outC);
      to.classList.add(inC);

      /** @param {AnimationEvent} e */
      const end = (e) => {
        if (e.target === to) {
          from.classList.remove(outC);
          to.classList.remove(inC);
          from.removeAttribute('active');
          to.removeEventListener('animationend', end);
          resolve();
        }
      };
      to.addEventListener('animationend', end);
    });
  }
}

customElements.define('x-slide', XSlide);
customElements.define('x-slide-container', XSlideContainer);
