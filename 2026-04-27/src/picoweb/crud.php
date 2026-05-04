<?php
// Module Parameters:
/** @var Model $param_class */
$param_class = $param_class ?? throw new Error('Undefined class');
/** @var array<string, Callable> $param_parsers */
$param_parsers = $param_parsers ?? throw new Error('Undefined parsers');
/** @var string $param_title */
$param_title = $param_title ?? throw new Error('Undefined title');

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
            'result' => $param_parsers[$name]($field),
        ];
    } catch (Exception $exn) {
        return [
            'success' => false,
            'error' => $exn->getMessage(),
        ];
    }
};

$validation_errors = [];
$runParsers = function () use ($param_class, $runParser, &$validation_errors): array {
    $final_values = [];

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

//// API-like operations

$resolved_pointers = [];
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
        $id_parse_result = $runParser($id_column, $_POST['id']);
        if (!$id_parse_result['success']) {
            http_response_code(400);
            echo 'Invalid ID field';
            exit;
        }
        $form_id = $id_parse_result['result'] ?? null;
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
                $runParsers();
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
    <form method="post">
    </form>
    <table>
        <thead>
            <?php foreach ($columns as $col): ?>
                <th><?= h($col) ?></th>
            <?php endforeach; ?>
        </thead>
        <tbody>
            <?php foreach ($records as $rec): ?>
                <tr>
                    <?php foreach ($columns as $col): ?>
                        <td><?= h($rec->data[$col]) ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <script>
    </script>
</body>

</html>
