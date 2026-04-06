API: DolarAPI, endpoint REST+JSON https://dolarapi.com/v1/dolares, extraer casas oficial, blue y bolsa (MEP).

Idealmente uno usa un cache para esto.

Componentes

- Un input que tiene el valor a convertir
- Un botón que muestre la tabla y haga las conversiones, o que muestre los errores actuales
- Una tabla que muestre: Tipo de dólar, Compra por unidad, Venta por unidad, Compra total, Venta total

Errores potenciales:

- El input está vacío
- El valor del input no es un número
- La API falla
