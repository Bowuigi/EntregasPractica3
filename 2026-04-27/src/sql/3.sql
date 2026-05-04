CREATE TABLE examenes (
    id_examen INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    id_alumno INTEGER NOT NULL REFERENCES alumnos (id_alumno),
    id_materia INTEGER NOT NULL REFERENCES materias (id_materia),
    nota INTEGER NOT NULL REFERENCES notas (id_nota),
    UNIQUE (id_alumno, id_materia)
);
