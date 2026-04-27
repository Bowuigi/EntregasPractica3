-- No se usan en SQLite
-- CREATE DATABASE escuela;
-- USE escuela;

CREATE TABLE alumnos (
    id_alumno  INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    nombre     TEXT NOT NULL,
    edad       INTEGER NOT NULL,
    dni        INTEGER UNIQUE NOT NULL,
    email      TEXT NOT NULL,
    id_carrera INTEGER NOT NULL,
    FOREIGN KEY (id_carrera) REFERENCES carreras (id_carrera)
);

CREATE TABLE materias (
    id_materia  INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    nombre      TEXT NOT NULL,
    curso       INTEGER NOT NULL,
    id_profesor INTEGER NOT NULL,
    id_carrera  INTEGER NOT NULL,
    FOREIGN KEY (id_carrera) REFERENCES carreras (id_carrera),
    FOREIGN KEY (id_profesor) REFERENCES profesor (id_profesor)
);

CREATE TABLE profesores (
    id_profesor INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    nombre      TEXT NOT NULL,
    email       TEXT NOT NULL
);

CREATE TABLE carreras (
    id_carrera INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    nombre     TEXT NOT NULL
);
