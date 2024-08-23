<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="edit.css">
    <title>Document</title>
</head>
<body>
<div class="container">
    <div class="form-container">
        <h2>Edit user information</h2>
        <form action="edit.php" method="post">
            <!-- Скрытое поле для передачи id пользователя -->
            <input type="hidden" id="id" name="id" value="<?php echo isset($_GET['id']) ? htmlspecialchars($_GET['id']) : ''; ?>">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" required>
            </div>
            <button class="submit" type="submit">Submit</button>
            <a class="cancel-button" href="/app/index.php">Cancel</a>
        </form>
        <?php
        // Проверка, что запрос был отправлен методом POST
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "appdatabase";
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Получение данных из POST-запроса
            $id = isset($_POST["id"]) ? $conn->escape_string($_POST["id"]) : '';
            $name = isset($_POST["name"]) ? $conn->escape_string($_POST["name"]) : '';
            $email = isset($_POST["email"]) ? $conn->escape_string($_POST["email"]) : '';
            $password = isset($_POST["password"]) ? $conn->escape_string($_POST["password"]) : '';
            $address = isset($_POST["address"]) ? $conn->escape_string($_POST["address"]) : '';

            if ($id) {
                // Подготовка запроса на обновление данных пользователя
                $sql = "UPDATE users SET name=?, email=?, password=?, address=? WHERE id=?";
                $stmt = $conn->prepare($sql);
                if ($stmt === false) {
                    die("Prepare failed: " . $conn->error);
                }

                // Привязка параметров к плейсхолдерам
                $stmt->bind_param('ssssi', $name, $email, $password, $address, $id);

                // Выполнение запроса
                $stmt->execute();

                // Проверка количества затронутых строк для подтверждения успешного обновления
                if ($stmt->affected_rows > 0) {
                    echo 'User updated successfully';
                } else {
                    echo 'No changes made or user not found';
                }

                $stmt->close();
            } else {
                echo 'No user id provided';
            }

            $conn->close();
        }
        ?>
    </div>
</div>
</body>
</html>
