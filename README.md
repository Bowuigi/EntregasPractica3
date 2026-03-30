# Entregas de Practica Profesionalizante III

La carpeta `lib` tiene librerías compartidas entre proyectos de distintos días.

El resto de las carpetas tienen la fecha en la cual se iniciaron a realizar.

El proyecto entero usa JSDoc en combinación con módulos ECMAScript nativos para simplificar la verificación, por tanto, las siguientes herramientas funcionan correctamente:

- Cualquier comando que verifique TypeScript o JavaScript + JSDoc (con sintaxis de TypeScript, Flow puede funcionar pero no está testeado). Personalmente utilizo `deno check -c tsconfig.json`.
- Cualquier LSP con acceso a los tipos declarados, como `typescript-language-server`.
- Cualquier extensión de tu editor favorito que utilice una LSP compatible.
