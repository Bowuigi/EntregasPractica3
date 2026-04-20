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

INSERT INTO materias (nombre, curso, id_profesor, id_carrera) VALUES
    ('Teología del Cuerpo', 2026, 7, 1),
    ('Sacramentos', 2017, 2, 3),
    ('Derecho Canónico', 2025, 9, 1),
    ('Islam', 2020, 4, 2),
    ('Herejías Comúnes', 1998, 5, 4),
    ('Ángeles', 2000, 4, 3),
    ('Efemérides', 2026, 8, 4),
    ('Teoría de la Guerra Justa', 2018, 4, 1),
    ('La Esencia del Amor', 2025, 10, 4),
    ('Historia de la Iglesia', 2000, 9, 1),
    ('Griego Koiné', 2025, 1, 3),
    ('Latín', 2025, 2, 3)
;

INSERT INTO alumnos (nombre, edad, dni, email, id_carrera) VALUES
    ('León XIV', 25, 28302939, 'leonxiv@vatican.va', 1),
    ('Cura Brochero', 21, 12948920, 'curabrochero@vatican.va', 2),
    ('Pío de Pietrelcina', 37, 28392938, 'piodepietrelcina@vatican.va', 3),
    ('Miguel Arcángel', 18, 99283829, 'miguelarcangel@vatican.va', 4),
    ('Gabriel Arcángel', 77, 84638384, 'gabrielarcangel@vatican.va', 1),
    ('Teresa de Lisieux', 27, 74738382, 'teresadelisieux@vatican.va', 2),
    ('Teresa de la Cruz', 65, 85746353, 'teresadelacruz@vatican.va', 3),
    ('Maravillas de Jesús', 53, 37329572, 'maravillasdejesus@vatican.va', 4),
    ('Ceferino Namuncurá', 19, 73636484, 'ceferinonamuncura@vatican.va', 1),
    ('Juan de la Cruz', 27, 87383949, 'juandelacruz@vatican.va', 2)
;
