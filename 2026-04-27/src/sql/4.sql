INSERT INTO usuarios (contrasena, nombre, email) VALUES
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
    ('Derecho Canónico', 2025, 4, 1, 6),
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
    ('Teresa de la Cruz', '2022-03-07', 85746353, 'teresadelacruz@vatican.va', 3),
    ('Maravillas de Jesús', '2022-03-07', 37329572, 'maravillasdejesus@vatican.va', 4),
    ('Ceferino Namuncurá', '2022-03-07', 73636484, 'ceferinonamuncura@vatican.va', 1),
    ('Juan de la Cruz', '2022-03-07', 87383949, 'juandelacruz@vatican.va', 2)
;
