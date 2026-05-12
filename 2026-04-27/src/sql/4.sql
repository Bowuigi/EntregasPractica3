INSERT INTO usuarios (contrasena, nombre, email) VALUES
  ('admin', 'admin', 'admin@example.com'),
  ('obviamente inseguro', 'Bob', 'bob@cybersec.net'),
  ('hunter2', 'John', 'john@users.net'),
  ('12345678', 'Bárbara', 'barbara@finance.net')
;

INSERT INTO carreras (nombre) VALUES
    ('Doctorado en Derecho Canónico'),
    ('Maestría en Divinidad'),
    ('Sacerdocio'),
    ('Diplomatura en Catecismo')
;

INSERT INTO profesores (nombre, email) VALUES
    ('Pablo de Tarso', 'pablodetarso@vatican.va'),
    ('Ignacio de Antioquía', 'ignaciodeantioquia@vatican.va'),
    ('Tomás de Aquino', 'tomasdeaquino@vatican.va'),
    ('Nicolás de Bari', 'nicolasdebari@vatican.va'),
    ('Juan Crisóstomo', 'juancrisostomo@vatican.va'),
    ('Juan Pablo II', 'juanpabloii@vatican.va'),
    ('Francisco', 'francisco@vatican.va'),
    ('Benedicto XVI', 'benedictoxvi@vatican.va'),
    ('Teresa de Calcuta', 'teresadecalcuta@vatican.va'),
    ('Agustín de Hipona', 'agustindehipona@vatican.va')
;

INSERT INTO materias (nombre, curso, id_profesor, id_carrera, nota_aprobacion) VALUES
    ('Teología del Cuerpo', 2, 6, 1, 6),
    ('Sacramentos', 1, 2, 3, 6),
    ('Derecho Canónico', 3, 4, 1, 6),
    ('Islam', 3, 4, 2, 6),
    ('Herejías Comúnes', 1, 5, 4, 6),
    ('Ángeles', 2, 4, 3, 6),
    ('Efemérides', 1, 8, 4, 6),
    ('Teoría de la Guerra Justa', 3, 4, 1, 6),
    ('La Esencia del Amor', 2, 10, 4, 6),
    ('Historia de la Iglesia', 4, 9, 1, 6),
    ('Griego Koiné', 2, 1, 3, 6),
    ('Latín', 3, 2, 3, 6)
;

INSERT INTO alumnos (nombre, fecha_nacimiento, dni, email, id_carrera) VALUES
    ('León XIV', '2022-03-07', 28302939, 'leonxiv@vatican.va', 1),
    ('Cura Brochero', '2022-03-07', 12948920, 'curabrochero@vatican.va', 2),
    ('Pío de Pietrelcina', '2022-03-07', 28392938, 'piodepietrelcina@vatican.va', 3),
    ('Miguel Arcángel', '2022-03-07', 99283829, 'miguelarcangel@vatican.va', 4),
    ('Gabriel Arcángel', '2022-03-07', 84638384, 'gabrielarcangel@vatican.va', 1),
    ('Teresa de Lisieux', '2022-03-07', 74738382, 'teresadelisieux@vatican.va', 2),
    ('Policarpo de Smyrna', '2022-03-07', 85746353, 'policarpodesmyrna@vatican.va', 3),
    ('Maravillas de Jesús', '2022-03-07', 37329572, 'maravillasdejesus@vatican.va', 4),
    ('Ceferino Namuncurá', '2022-03-07', 73636484, 'ceferinonamuncura@vatican.va', 1),
    ('Juan de la Cruz', '2022-03-07', 87383949, 'juandelacruz@vatican.va', 2)
;

-- AI generated data ahead

-- More usuarios (add 10)
INSERT INTO usuarios (contrasena, nombre, email) VALUES
  ('s3cr3t!', 'Alice Chen', 'alice.chen@example.com'),
  ('p@ssw0rd', 'Bob Marley', 'bob.marley@reggae.com'),
  ('letmein', 'Carol Danvers', 'carol.danvers@avengers.org'),
  ('admin123', 'David Attenborough', 'david@nature.com'),
  ('qwerty', 'Elena Rodriguez', 'elena.rodriguez@tech.net'),
  ('iloveSQL', 'Frank Herbert', 'frank@arrakis.space'),
  ('password', 'Grace Hopper', 'grace@navy.mil'),
  ('hello_world', 'Hiroshi Tanaka', 'hiroshi.tanaka@jp.co'),
  ('123456789', 'Irene Adler', 'irene.adler@consultant.uk'),
  ('!@#$%^', 'James Kirk', 'jkirk@starfleet.ufp');

-- More carreras (add 6)
INSERT INTO carreras (nombre) VALUES
  ('Ingeniería Informática'),
  ('Licenciatura en Matemáticas'),
  ('Ciencias Ambientales'),
  ('Diseño Gráfico'),
  ('Administración de Empresas'),
  ('Filosofía Contemporánea');

-- More profesores (add 8)
INSERT INTO profesores (nombre, email) VALUES
  ('Ada Lovelace', 'ada.lovelace@computing.hist'),
  ('Alan Turing', 'alan.turing@crypto.uk'),
  ('Marie Curie', 'marie.curie@physics.fr'),
  ('Carl Sagan', 'carl.sagan@cosmos.edu'),
  ('Jane Goodall', 'jane.goodall@primatology.org'),
  ('Noam Chomsky', 'noam.chomsky@linguistics.mit'),
  ('Simone de Beauvoir', 'simone.debeauvoir@existentialism.fr'),
  ('Stephen Hawking', 'stephen.hawking@cosmology.uk');

-- More materias (add 15)
INSERT INTO materias (nombre, curso, id_profesor, id_carrera, nota_aprobacion) VALUES
  ('Programación Orientada a Objetos', 1, 11, 5, 6),
  ('Estructuras de Datos', 2, 11, 5, 6),
  ('Bases de Datos Relacionales', 2, 12, 5, 5),
  ('Cálculo Avanzado', 3, 13, 6, 6),
  ('Álgebra Lineal', 1, 13, 6, 5),
  ('Ecología General', 1, 14, 7, 6),
  ('Gestión de Residuos', 2, 15, 7, 6),
  ('Tipografía y Composición', 1, 16, 8, 6),
  ('Diseño de Interfaces', 2, 16, 8, 6),
  ('Marketing Digital', 1, 17, 9, 5),
  ('Finanzas Corporativas', 2, 17, 9, 6),
  ('Introducción a la Ética', 1, 18, 10, 5),
  ('Lógica y Argumentación', 2, 18, 10, 5),
  ('Historia de la Ciencia', 3, 14, 10, 6),
  ('Astrofísica para Filósofos', 4, 15, 10, 6);

-- More alumnos (add 30, total 40)
INSERT INTO alumnos (nombre, fecha_nacimiento, dni, email, id_carrera) VALUES
  ('Ada Lovelace II', '2000-12-10', 10111213, 'ada.lovelace.jr@example.com', 5),
  ('Charles Babbage', '1999-03-15', 14151617, 'charles.babbage@example.com', 5),
  ('Katherine Johnson', '2001-08-22', 18192021, 'katherine.johnson@nasa.gov', 6),
  ('Margaret Hamilton', '2000-05-05', 21222324, 'margaret.hamilton@mit.edu', 5),
  ('Tim Berners-Lee', '2002-11-11', 25262728, 'timbl@w3.org', 5),
  ('Linus Torvalds', '2001-02-28', 29303132, 'linus@linux.com', 5),
  ('Rosalind Franklin', '1998-07-19', 33343536, 'rosalind.franklin@dna.org', 7),
  ('Nikola Tesla', '2000-01-10', 37383940, 'nikola.tesla@energy.com', 6),
  ('Claude Shannon', '1999-04-30', 41424344, 'claude.shannon@info.org', 5),
  ('Grace Hopper Jr', '2002-09-17', 45464748, 'grace.hopper.jr@usn.mil', 5),
  ('Rachel Carson', '2001-06-05', 49505152, 'rachel.carson@silent.spring', 7),
  ('Frederick Sanger', '2000-12-25', 53545556, 'fred.sanger@biochem.uk', 7),
  ('Emmy Noether', '1999-11-07', 57585960, 'emmy.noether@algebra.de', 6),
  ('Srinivasa Ramanujan', '2001-04-26', 61626364, 'ramanujan@numbers.in', 6),
  ('Barbara Liskov', '2002-01-13', 65666768, 'barbara.liskov@cs.mit', 5),
  ('John von Neumann', '2000-09-08', 69707172, 'vonneumann@princeton.edu', 6),
  ('Jane Jacobs', '1998-12-04', 73747576, 'jane.jacobs@urban.plan', 9),
  ('David Attenborough Jr', '2001-03-21', 77787980, 'david.attenborough.jr@bbc.uk', 7),
  ('Mae Jemison', '2002-07-12', 81828384, 'mae.jemison@nasa.gov', 5),
  ('Neil deGrasse Tyson', '2000-02-29', 85868788, 'neil@amnh.org', 6),
  ('Hypatia of Alexandria', '1999-10-09', 89899091, 'hypatia@alexandria.edu', 10),
  ('Galileo Galilei', '2001-05-17', 92939495, 'galileo@starry.net', 6),
  ('Marie Skłodowska Curie', '2000-08-14', 96979899, 'marie.curie.jr@physics.fr', 6),
  ('Alan Turing Jr', '2002-03-03', 100101102, 'alan.turing.jr@crypto.uk', 5),
  ('Kurt Gödel', '1999-06-22', 103104105, 'kurt.godel@logic.at', 10),
  ('Ayn Rand', '2001-11-30', 106107108, 'ayn.rand@objectivism.us', 9),
  ('Martha Nussbaum', '2000-04-18', 109110111, 'martha.nussbaum@uchicago.edu', 10),
  ('Noam Chomsky Jr', '2002-10-05', 112113114, 'noam.chomsky.jr@linguistics.mit', 10),
  ('Simone Weil', '1999-08-25', 115116117, 'simone.weil@labor.ph', 10),
  ('José Mujica', '2001-12-01', 118119120, 'mujica@ecology.uy', 7);

INSERT INTO examenes (id_alumno, id_materia, nota) VALUES
-- Carrera 1 (Doctorado en Derecho Canónico)
-- =====================================================
(1, 1, 8), (1, 8, 7), (5, 1, 6), (5, 3, 5), (5, 8, 9), (5, 10, 7),
(9, 3, 8), (9, 8, 6), (9, 10, 9),

-- Carrera 2 (Maestría en Divinidad)
-- =====================================================
(2, 4, 7), (6, 4, 9), (10, 4, 6),

-- Carrera 3 (Sacerdocio)
-- =====================================================
(3, 2, 8), (3, 6, 7), (3, 11, 9), (3, 12, 6), (7, 2, 5), (7, 6, 8), (7, 11, 7), (7, 12, 9),

-- Carrera 4 (Diplomatura en Catecismo)
-- =====================================================
(4, 5, 9), (4, 7, 6), (4, 9, 8), (8, 5, 7), (8, 7, 8), (8, 9, 10),

-- Carrera 5 (Ingeniería Informática)
-- =====================================================
(11,13,9), (11,15,8), (12,13,6), (12,14,8), (12,15,9), (14,14,9),
(15,13,8), (15,14,6), (15,15,10), (16,13,5), (16,14,7), (16,15,8),
(19,13,9), (19,14,5), (19,15,7), (20,13,6), (20,14,8), (20,15,9),
(24,13,7), (24,14,9), (24,15,6),

-- Carrera 6
-- =====================================================
(13,16,8), (18,16,9), (18,17,6), (23,16,7), (23,17,8),
(24,16,6), (24,17,9), (26,16,8), (26,17,5), (30,16,7),
(32,16,9), (32,17,6), (33,16,5), (33,17,8),

-- Carrera 7 (Ciencias Ambientales)
-- =====================================================
(17,18,8), (17,19,7), (21,19,6), (22,18,7), (22,19,8),
(28,18,6), (28,19,9), (40,18,8), (40,19,7),

-- Carrera 8 (Diseño Gráfico)
-- Alumnos: none from new list? Check: no alumno has carrera 8. Only from original? Original alumnos all have 1-4. So none.
-- Therefore no examenes for carrera8.

-- Carrera 9 (Administración de Empresas)
-- =====================================================
(27,22,7), (27,23,8),

-- Carrera 10 (Filosofía Contemporánea)
-- =====================================================
(31,24,8), (31,25,7), (31,27,6), (35,24,6), (35,25,8), (35,26,7),
(37,24,9), (37,25,6), (37,26,8), (37,27,7), (38,25,9), (38,26,6),
(38,27,8), (39,24,8), (39,25,7), (39,26,9),

-- Some low grades (1-4) for carrera1
(1, 3, 2), (9, 1, 4),
-- Low grades for carrera5
(11,14,3), (14,15,2),
-- Low grades for carrera6
(13,17,3), (30,17,1),
-- Low grades for carrera9
(36,22,3),
-- Low grades for carrera10
(35,27,2), (38,24,3),

-- High grades (10) for some
(1, 10, 10), (14,13,10), (21,18,10), (36,23,10), (31,26,10), (39,27,10);
