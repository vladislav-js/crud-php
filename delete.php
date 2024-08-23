<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="delete.css">
    <title>Document</title>
</head>
<body>
<?php

// Настройки подключения к базе данных
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "appdatabase";

// Создание соединения
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Проверка, что идентификатор был передан через GET-запрос
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Преобразуем идентификатор в целое число

    // Подготовка и выполнение SQL-запроса для удаления записи
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $id); // Связываем параметр с запросом
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Record deleted successfully <br>";
        } else {
            echo "No record found with ID " . $id;
        }

        $stmt->close();
    } else {
        echo "Error preparing the SQL statement: " . $conn->error;
    }
} else {
    echo "No ID specified for deletion";
}

$conn->close();


?>
<a class="back" href="index.php"  role="button">Go back</a>
</body>
</html>