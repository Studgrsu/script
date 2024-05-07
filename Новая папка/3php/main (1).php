<!DOCTYPE html>
<html>
<head>
    <title>Умножение чисел</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h2, h3 {
            color: #333;
        }
        form {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h2>Умножение чисел</h2>
    <form method="post">
        <label for="num1">Первое число:</label>
        <input type="number" id="num1" name="num1" required>
        <br>
        <label for="num2">Второе число:</label>
        <input type="number" id="num2" name="num2" required>
        <br>
        <button type="submit">Умножить</button>
    </form>

    <?php
    if(isset($_POST['num1']) && isset($_POST['num2']) && $_POST['num1'] !== '' && $_POST['num2'] !== '') {
        $num1 = $_POST['num1'];
        $num2 = $_POST['num2'];
        $result = $num1 * $num2;

        $num1_str = (string)$num1;
        $num2_str = (string)$num2;
        $result_str = (string)$result;

        $num1_len = strlen($num1_str);
        $num2_len = strlen($num2_str);
        $result_len = strlen($result_str);

        $max_len = max($num1_len, $num2_len, $result_len + strlen((string)($num1 * $num2_str[0])));

        echo "<h3>Результат умножения:</h3>";
        echo "<pre>";
        echo str_pad($num1_str, $max_len, " ", STR_PAD_LEFT) . "\n";
        echo str_pad($num2_str, $max_len, " ", STR_PAD_LEFT) . "\n";
        echo str_repeat("-", $max_len) . "\n";
        $lines = [];
        for ($i = strlen($num2_str) - 1; $i >= 0; $i--) {
            $digit = $num2_str[$i];
            $product = $num1 * $digit;
            $lines[] = str_pad($product, $max_len - (strlen($num2_str) - $i - 1), " ", STR_PAD_LEFT);
        }
        foreach (array_reverse($lines) as $line) {
            echo $line . "\n";
        }
        echo str_repeat("-", $max_len) . "\n";
        echo str_pad($result_str, $max_len, " ", STR_PAD_LEFT) . "\n";
        echo "</pre>";
    }
    ?>
</body>
</html>
