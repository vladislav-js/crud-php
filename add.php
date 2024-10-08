<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link rel="stylesheet" href="add.css">
    <style>
        .message {
            margin-top: 10px;
            padding: 10px;
            border-radius: 4px;
            font-weight: bold;
        }
        .success {
            color: green;
            border: 1px solid green;
        }
        .error {
            color: red;
            border: 1px solid red;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="form-container">
        <h2>Add New User</h2>
        <form action="" method="post">
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
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "appdatabase";
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $name = $conn->real_escape_string($_POST['name']);
            $email = $conn->real_escape_string($_POST['email']);
            $password = $conn->real_escape_string($_POST['password']);
            $address = $conn->real_escape_string($_POST['address']);
            $sql = "INSERT INTO users (name, email, password, address) VALUES ('$name', '$email', '$password', '$address')";

            if ($conn->query($sql) === TRUE) {
                echo '<div class="message success">New record created successfully</div>';
            } else {
                echo '<div class="message error">Error: ' . $sql . '<br>' . $conn->error . '</div>';
            }

            $conn->close();
        }
        ?>
    </div>
</div>
</body>
</html>
