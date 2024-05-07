<!DOCTYPE html>
<html>
<head>
    <title>Регистрация</title>
</head>
<body>
    <h1>Регистрация</h1>
    <form action="registration.php" method="POST">
        <label for="name">Имя:</label>
        <input type="text" id="name" name="name" required><br><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" required><br><br>
        
        <input type="submit" value="Зарегистрироваться">
    </form>
</body>
</html>

<?php
$servername = "localhost";
$username = "root";
$password = "1111";
$dbname = "users";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];


$sql = "SELECT COUNT(*) AS count FROM users WHERE email = '$email'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
if ($row['count'] > 0) {
    die("Пользователь с таким email уже существует");
}


$hashedPassword = password_hash($password, PASSWORD_DEFAULT);


$sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashedPassword')";
if ($conn->query($sql) === TRUE) {
    echo "Регистрация успешна";
} else {
    echo "Ошибка регистрации: " . $conn->error;
}

$conn->close();
?>