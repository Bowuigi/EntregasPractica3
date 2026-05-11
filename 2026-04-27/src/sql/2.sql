CREATE TABLE notas (
    id_nota INTEGER PRIMARY KEY NOT NULL
);

INSERT INTO notas (id_nota) VALUES
  (1),
  (2),
  (3),
  (4),
  (5),
  (6),
  (7),
  (8),
  (9),
  (10)
;

ALTER TABLE materias ADD COLUMN
  nota_aprobacion INTEGER NOT NULL DEFAULT 6 REFERENCES notas (id_nota) ON DELETE RESTRICT;
