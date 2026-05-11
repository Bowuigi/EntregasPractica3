<?php
require_once __DIR__ . '/lib/config.php';

$roadmap = Services::with('db')->statement(
    '
    SELECT alumnos.id_alumno, alumnos.nombre as alumno, materias.id_materia, materias.nombre as materia, materias.curso, materias.nota_aprobacion, examenes.nota
    FROM
      alumnos
      INNER JOIN materias
        ON alumnos.id_carrera = materias.id_carrera
      LEFT JOIN examenes
        ON alumnos.id_alumno = examenes.id_alumno AND materias.id_materia = examenes.id_materia
    GROUP BY alumnos.id_alumno
    ORDER BY materias.curso ASC, materias.nombre ASC
    ',
    []
);

// Why say many word when few word do trick?
function h(string $str)
{
    return htmlspecialchars($str);
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mateo Crimella - Práctica 3</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <table>
        <thead>
            <th>Alumno</th>
            <th>Materia</th>
            <th>Curso</th>
            <th>Nota</th>
            <th>Nota de aprobación</th>
        </thead>
        <tbody>
            <?php foreach ($roadmap as $r): ?>
                <tr>
                    <td><?= h($r['alumno']) ?></td>
                    <td><?= h($r['materia']) ?></td>
                    <td><?= h($r['curso']) ?></td>
                    <td><?= h($r['nota'] ?? 'No rindió') ?></td>
                    <td><?= h($r['nota_aprobacion']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>
