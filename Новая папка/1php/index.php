<?php
function isPrime($number) {
    if ($number < 2) {
        return false;
    }
    
    for ($i = 2; $i * $i <= $number; $i++) {
        if ($number % $i == 0) {
            return false;
        }
    }

    return true;
}

if (isset($_GET["info"])) {
    $info = $_GET['info'];
    echo "Информация URL параметров: " . htmlspecialchars($info);
} elseif (isset($_GET["number"])) {
    $number = intval($_GET["number"]);

    if ($number > 0 && $number <= 1000) {
        $primes = [];

        for ($i = 2; $i <= $number; $i++) {
            if (isPrime($i)) {
                $primes[] = $i;
            }
        }

        echo "Простые числа не больше " . $number . ": ";
        echo implode(", ", $primes);
    } else {
        echo "Число должно быть от 1 до 1000.";
    }
} else {
    echo "URL-параметры не указаны.";
}
?>








































































<!-- пасхалка -->