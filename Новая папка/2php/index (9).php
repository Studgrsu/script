<?php
// Проверяем наличие файла
$filename = 'titanic.csv';
if (!file_exists($filename)) {
    die("Файл $filename не найден.");
}

// Функция для построчного чтения файла CSV
function readCsv($filename) {
    $file = fopen($filename, "r");
    while (($row = fgetcsv($file)) !== false) {
        yield $row;
    }
    fclose($file);
}

// Функция для поиска по возрасту
function searchByAge($age, $data) {
    $results = array();
    foreach ($data as $row) {
        if (isset($row[4]) && $row[4] != '' && $row[4] == $age) {
            $results[] = $row;
        }
    }
    return $results;
}

// Функция для поиска по имени
function searchByName($name, $data) {
    $results = array();
    foreach ($data as $row) {
        if (isset($row[2]) && preg_match('/\b' . preg_quote($name, '/') . '\b/i', $row[2])) {
            $results[] = $row;
        }
    }
    return $results;
}

// Обработка запроса
$age = (int) filter_input(INPUT_POST, 'age');
$name = filter_input(INPUT_POST, 'name');

$data = readCsv($filename);
next($data); // Пропускаем заголовок

$ageResults = searchByAge($age, $data);
$nameResults = searchByName($name, $data);

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Результаты поиска пассажиров Титаника</title>
</head>
<body>
    <h1>Результаты поиска</h1>
    <?php if (empty($ageResults) && empty($nameResults)): ?>
        <p>Нет результатов.</p>
    <?php endif; ?>
    <h2>Поиск по возрасту (<?php echo $age; ?>):</h2>
    <ul>
        <?php foreach ($ageResults as $row): ?>
            <li><?php echo htmlspecialchars($row[2]); ?> (<?php echo htmlspecialchars($row[4]); ?>)</li>
        <?php endforeach; ?>
    </ul>
    <h2>Поиск по имени (<?php echo htmlspecialchars($name); ?>):</h2>
    <ul>
        <?php foreach ($nameResults as $row): ?>
            <li><?php echo htmlspecialchars($row[2]); ?> (<?php echo htmlspecialchars($row[4]); ?>)</li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
