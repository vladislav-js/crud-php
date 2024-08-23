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
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "appdatabase";
$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "DELETE FROM users WHERE username = id=?";
// Получаем ID с помощью запроса
$id =isset ($_GET['id']) ? intval( $_GET['id']) : 0;
// Подготовка запроса к БД
if ($id) {
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    // Проверка на ошибки
    if ($stmt == false) {
        echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
    }
    // Присваивание "i" данные переменной $id
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "Record deleted successfully <br>" ;
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    $stmt->close();
}
$conn->close();
?> <br>
<a class="back" href="index.php" >Go back</a>
</body>
</html>