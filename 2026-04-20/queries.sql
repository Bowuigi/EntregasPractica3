-- 1. Cuántos alumnos tiene cada materia?
SELECT materias.id_materia, materias.nombre AS materia, count(id_alumno) AS cantidad
FROM materias INNER JOIN alumnos ON materias.id_carrera = alumnos.id_carrera
GROUP BY materias.id_materia, materias.nombre;

-- 2. Cuántos alumnos tiene cada carrera?
SELECT carreras.id_carrera, carreras.nombre AS carrera, count(id_alumno) AS cantidad
FROM carreras INNER JOIN alumnos ON carreras.id_carrera = alumnos.id_carrera
GROUP BY carreras.id_carrera;

-- 3. Qué debemos modificar en la base de datos para poder guardar las notas?
CREATE TABLE nota (
    id_nota INTEGER NOT NULL,
);

INSERT INTO nota VALUES
  (1) (2) (3) (4) (5) (6) (7) (8) (9) (10);

CREATE TABLE rindio (
    id_alumno INTEGER NOT NULL,
    id_materia INTEGER NOT NULL,
    nota INTEGER NOT NULL,
    FOREIGN KEY (id_alumno) REFERENCES alumnos (id_alumno),
    FOREIGN KEY (id_materia) REFERENCES materias (id_materia),
    FOREIGN KEY (nota) REFERENCES nota (id_nota)
);

-- Consigna sin número
ALTER TABLE materias ADD COLUMN
  nota_aprobacion INTEGER NOT NULL DEFAULT 6 REFERENCES nota (id_nota);

-- Consigna sin número

ALTER TABLE alumnos ADD COLUMN
  fecha_nacimiento DATE;

UPDATE alumnos SET fecha_nacimiento = date(unixepoch() - edad*365*24*60*60, 'unixepoch');

-- 4. Trayectoria de un alumno
INSERT INTO rindio (id_alumno, id_materia, nota) VALUES
  (1, 1, 9),
  (1, 3, 10)
;

SELECT alumnos.id_alumno, alumnos.nombre, materias.id_materia, materias.nombre, materias.curso, materias.nota_aprobacion, rindio.nota
FROM
  alumnos
  INNER JOIN materias
    ON alumnos.id_carrera = materias.id_carrera
  LEFT JOIN rindio
    ON alumnos.id_alumno = rindio.id_alumno AND materias.id_materia = rindio.id_materia
WHERE alumnos.id_alumno=1
ORDER BY materias.curso ASC, materias.nombre ASC;
