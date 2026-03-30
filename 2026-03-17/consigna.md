# Trabajo Práctico: Juego de Memoria y Suma

## Objetivo

Desarrollar una aplicación web utilizando HTML, CSS y JavaScript puro que permita ejercitar la memoria y el cálculo mental.

## Descripción

La aplicación mostrará una serie de números uno por vez con un intervalo configurable. Al finalizar, el usuario deberá ingresar la suma total.

## Ejemplo de funcionamiento

**Secuencia mostrada:**

5 → 3 → -2 → 4

**Cálculo esperado:** 5 + 3 - 2 + 4 = 10

**Respuesta del usuario:** 10 → Correcto.

**Otro ejemplo:** 2 → -5 → 6, resultado esperado: 3

## Requisitos funcionales

**Generación de números:** {Todo implementado en site/lib/sequence.js}
1. Secuencia de números aleatorios.
2. Posibilidad de incluir números negativos.
**Visualización:**
1. Mostrar un número a la vez. {Listo}
2. Intervalo configurable (mínimo 1 segundo). {Listo}
3. Posible pausa o transición entre números. {Listo}
**Configuración:**
1. Cantidad de números. {Listo}
2. Tiempo entre números. {Listo}
3. Permitir o no números negativos. {Listo}
**Ingreso de respuesta:**
1. Campo de entrada para la suma.
2. Botón para confirmar.
**Validación:**
1. Indicar si es correcto o incorrecto.
2. Mostrar resultado correcto si falla.

## Regla importante

La suma final no debe ser negativa. {Listo}

## Requisitos de interfaz

1. Interfaz clara y simple.
2. Número visible y centrado.
3. Indicadores de estado. {??????}
4. Feedback visual (correcto/incorrecto).

## Extras (opcionales)

1. Temporizador. {Falta conectarlo usando AppState.startTimestamp}
2. Puntaje acumulado. {Falta agregar en AppState}
3. Animaciones. {Está el handler en handleSequenceDisplay}
4. Niveles de dificultad. {La lógica está, falta hacer un mini-formulario que arranque con uno de los presets y permita editarlo}
5. Historial de partidas. {Está en AppState, requiere un gameplay loop}

## Restricciones

No utilizar frameworks ni librerías externas. Todo debe ser JavaScript puro.

## Criterios de Evaluación

1. Correcto funcionamiento de la lógica.
2. Uso adecuado del DOM y eventos.
3. Código claro y organizado.
4. Manejo de tiempos (`setTimeout`/`setInterval`).
5. Experiencia de usuario.

## Específico a esta implementación

Una serie de 'slides' (se muestra una a la vez, debe haber una función que cambie a la siguiente, el sistema debe ser genérico, posiblemente usando Web Components):

- Configuración (el formulario con los presets)
- Secuencia numérica (muestra un número a la vez, quizás usando el mismo sistema de slides para implementar las animaciones una sola vez)
- Input para ingresar un número a fin de inferir el resultado de la suma
- Ganaste / Perdiste + botón de jugar otra vez (que vuelva a la primer slide)
