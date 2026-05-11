<?php
// Module Parameters:
/** @var Model $param_class */
$param_class = $param_class ?? throw new Exception('Undefined class');
/** @var array<string, Callable> $param_parsers */
$param_parsers = $param_parsers ?? throw new Exception('Undefined parsers');
/** @var string $param_title */
$param_title = $param_title ?? throw new Exception('Undefined title');
/** @var array<string, 'id_pk' | 'id_fk' | 'text' | 'password' | 'email' | 'boolean' | 'date' | 'number'> */
$param_types = $param_types ?? throw new Exception('Undefined types');
/** @var array<string, string> $param_names */
$param_names = $param_names ?? throw new Exception('Undefined user-readable names');

//// Helpers

// Why say many word when few word do trick?
function h(string $str)
{
    return htmlspecialchars($str);
}

$runParser = function (string $name, string $field) use ($param_parsers) {
    try {
        return [
            'success' => true,
            'value' => $param_parsers[$name]($field),
        ];
    } catch (Exception $exn) {
        return [
            'success' => false,
            'error' => $exn->getMessage(),
        ];
    }
};

$validation_errors = [];
$runParsers = function (int|null $id) use ($param_class, $runParser, &$validation_errors): array {
    $final_values = [
        $param_class::$id_column => $id,
    ];

    foreach ($param_class::$fillable as $column) {
        $raw_value = $_POST["form_{$column}"] ?? '';
        $parse_result = $runParser($column, $raw_value);

        if ($parse_result['success']) {
            $final_values[$column] = $parse_result['value'];
        } else {
            array_push($validation_errors, $parse_result['error']);
        }
    }

    if (count($validation_errors) === 0) {
        $param_class::save([new $param_class($final_values)]);
    }

    return $validation_errors;
};

$resolved_pointers = [];
$columnToInput = function (string $column, string $html_id) use ($param_types, $resolved_pointers) {
    $input_type = $param_types[$column];
    switch ($input_type) {
        case 'id_pk':
            return "<input type=\"hidden\" id=\"{$html_id}\" name=\"id\">";
        case 'text':
            return "<input type=\"text\" id=\"{$html_id}\" name=\"form_{$column}\">";
        case 'password':
            return "<input type=\"password\" id=\"{$html_id}\" name=\"form_{$column}\">";
        case 'email':
            return "<input type=\"email\" id=\"{$html_id}\" name=\"form_{$column}\">";
        case 'boolean':
            return "<input type=\"checkbox\" id=\"{$html_id}\" name=\"form_{$column}\">";
        case 'date':
            return "<input type=\"date\" id=\"{$html_id}\" name=\"form_{$column}\">";
        case 'number':
            return "<input type=\"number\" id=\"{$html_id}\" name=\"form_{$column}\">";
        case 'id_fk': {
                $output = "<select id=\"{$html_id}\" name=\"form_{$column}\">";
                foreach ($resolved_pointers as $id => $repr) {
                    $output .= "<option value=\"{$id}\">{$repr}</option>";
                }
                $output .= '</select>';
                return $output;
            }
    }
};

//// API-like operations

foreach ($param_class::$pointers as $column => $model_class) {
    $resolved_pointers[$column] = $model_class::representatives();
}

/* Request data sent:
 - Delete
   operation: delete
   id: <id to delete>
 - Create
   operation: modify
   id: null
   form_<fillable field>: <value>
 - Edit
   operation: modify
   id: <id to edit>
   form_<fillable field>: <value>
*/
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $form_id = null;

    if (isset($_POST['id'])) {
        $id_parse_result = $runParser($param_class::$id_column, $_POST['id']);
        if (!$id_parse_result['success']) {
            http_response_code(400);
            echo 'Invalid ID field';
            exit;
        }
        $form_id = $id_parse_result['value'] ?? null;
    }

    switch ($_POST['operation'] ?? '') {
        case 'delete': {
                if (is_null($form_id)) {
                    http_response_code(400);
                    echo 'Invalid ID field on delete operation';
                    exit;
                }
                $param_class::deleteOne($form_id);
                break;
            }
        case 'modify': {
                $runParsers($form_id);
                break;
            }
        default: {
                http_response_code(400);
                echo 'Missing or invalid operation';
                exit;
            }
    }
}

$records = $param_class::all();
$id_column = $param_class::$id_column;
$columns = array_merge([$id_column], $param_class::$fillable);

//// UI
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= h($param_title) ?></title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <ul>
        <?php foreach ($validation_errors as $err): ?>
            <li><?= h($err) ?></li>
        <?php endforeach; ?>
    </ul>
    <form method="post" id="modify-form">
        <input type="hidden" name="operation" value="modify">
        <?php foreach ($columns as $col): ?>
            <?php if ($col !== $param_class::$id_column): ?>
            <label for="form-<?= h($col) ?>"><?= h($param_names[$col]) ?></label>
            <?php endif; ?>
            <?= $columnToInput($col, "form-{$col}") ?>
        <?php endforeach; ?>
        <button type="reset" onclick="fullFormReset('modify-form')">Limpiar formulario</button>
        <button type="submit">Crear / Modificar</button>
    </form>
    <table>
        <thead>
            <?php foreach ($columns as $col): ?>
                <th><?= h($param_names[$col]) ?></th>
            <?php endforeach; ?>
            <th>Acciones</th>
        </thead>
        <tbody>
            <?php foreach ($records as $rec): ?>
                <tr>
                    <?php foreach ($columns as $col): ?>
                        <!---  TODO: Pointer handling  --!>
                        <td id="row-<?= h($rec->id()) ?>-<?= h($col) ?>"><?= h($rec->data[$col]) ?></td>
                    <?php endforeach; ?>
                    <td>
                        <form method="post" style="display: inline;">
                            <input type="hidden" name="operation" value="delete">
                            <button type="submit" name="id" value="<?= h($rec->id()) ?>">Borrar</button>
                        </form>
                        <button type="button" onclick="edit(<?= h($rec->id()) ?>)">Editar</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <script type="text/javascript">
        function edit(id) {
            const columns = <?= json_encode($columns) ?>;
            for (const col of columns) {
                const elem = document.getElementById(`row-${id}-${col}`);
                const formElem = document.getElementById(`form-${col}`);

                switch (formElem.type) {
                    default: formElem.value = elem.textContent;
                }
            }
        }

        function fullFormReset(id) {
            const form = document.getElementById(id);
            form.reset();
            const id_input = document.getElementById(`form-<?= $id_column ?>`);
            id_input.value = null;
        }
    </script>
</body>

</html>
