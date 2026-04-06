export type Trivia = {
  categorias: Array<{nombre: string, preguntas: Array<Question>}>,
};

export type Question = {
  id: string,
  pregunta: string,
  correcta: string,
  incorrectas: Array<string>,
  nivel: 'facil' | 'medio' | 'dificil',
};
