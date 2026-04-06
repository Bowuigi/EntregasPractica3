// @ts-check
import { bindAllWithPrefix, bindAllWithSuffix, fromCamelCase, toCamelCase } from "./binding.js";

const formatCurrency = new Intl.NumberFormat('es-AR', { style: "currency", currency: 'ARS' }).format;

const currencyMarkets = /** @type {const} */([
  'oficial-buy', 'oficial-sell',
  'blue-buy', 'blue-sell',
  'bolsa-buy', 'bolsa-sell',
]);

const valuePerUnit = bindAllWithSuffix('-value-per-unit', currencyMarkets);
const valueTotal = bindAllWithSuffix('-value-total', currencyMarkets);

/** @typedef {Array<{
                moneda: 'USD',
                casa: string,
                nombre: string,
                compra: number,
                venta: number,
                fechaActualizacion: string
             }>} APIResponse */

/** @typedef {Record<string, {buy: number, sell: number}>} CurrencyCache */

/** @type { () => Promise<{success: false} | {success: true, currencies: CurrencyCache}> } */
async function cacheData() {
  /** @type {Response} */
  let response;
  try {
    response = await fetch('https://dolarapi.com/v1/dolares');
    if (response.ok === false) return { success: false };
  } catch {
    return { success: false };
  }

  /** @type {APIResponse} */
  const json = await response.json();
  /** @type {CurrencyCache} */
  const currencies = Object.fromEntries(json.map(c => [c.casa, { buy: c.compra, sell: c.venta }]));

  for (const c of currencyMarkets) {
    const [market, buyOrSell] = c.split('-');
    valuePerUnit[toCamelCase(c)].textContent = formatCurrency(currencies[market][buyOrSell]);
  }

  return { success: true, currencies };
}
const currencyCache = await cacheData();

const amountForm = /**@type{ {input: HTMLInputElement, submit: HTMLButtonElement, errorMessage: HTMLParagraphElement} }*/(
  bindAllWithPrefix('amount-', /**@type{const}*/(['input', 'submit', 'error-message']))
);

/** @param {string} msg */
function amountFormFail(msg) {
    amountForm.errorMessage.textContent = msg;
    amountForm.errorMessage.classList.remove('msg-ok');
    amountForm.errorMessage.classList.add('msg-error');
    for (const elem of Object.values(valueTotal)) {
      elem.textContent = formatCurrency(0);
    }
}

/** @param {number} input */
function amountFormOk(input) {
    if (currencyCache.success === false) {
      amountFormFail('Error al cargar la API');
      return;
    }
    amountForm.errorMessage.textContent = 'Ok';
    amountForm.errorMessage.classList.remove('msg-error');
    amountForm.errorMessage.classList.add('msg-ok');
    for (const [key, elem] of Object.entries(valueTotal)) {
      const [market, buyOrSell] = fromCamelCase(key).split('-');
      elem.textContent = formatCurrency(currencyCache.currencies[market][buyOrSell] * input);
    }
}

amountForm.submit.addEventListener('click', () => {
  const input = Number(amountForm.input.value);
  if (amountForm.input.value === '') {
    amountFormFail('Se requiere un número');
    return;
  }
  if (isNaN(input) || !isFinite(input)) {
    amountFormFail('Número inválido');
    return;
  }
  if (input < 0) {
    amountFormFail('El número debe ser positivo');
    return;
  }
  amountFormOk(input);
});
