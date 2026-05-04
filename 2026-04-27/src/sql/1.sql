CREATE TABLE carreras (
    id_carrera INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nombre     TEXT NOT NULL
);

CREATE TABLE profesores (
    id_profesor INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nombre      TEXT NOT NULL,
    email       TEXT NOT NULL
);

CREATE TABLE alumnos (
    id_alumno  INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nombre     TEXT NOT NULL,
    edad       INTEGER NOT NULL,
    dni        INTEGER UNIQUE NOT NULL,
    email      TEXT NOT NULL,
    id_carrera INTEGER NOT NULL REFERENCES carreras (id_carrera)
);

CREATE TABLE materias (
    id_materia  INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nombre      TEXT NOT NULL,
    curso       INTEGER NOT NULL,
    id_profesor INTEGER NOT NULL REFERENCES profesores (id_profesor),
    id_carrera  INTEGER NOT NULL REFERENCES carreras (id_carrera)
);
