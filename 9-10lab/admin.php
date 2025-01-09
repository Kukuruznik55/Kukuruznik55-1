<!DOCTYPE html> 
<html>
<head>
    <title>Админ панель</title>
    <style>
      body {
    font-family: 'Roboto', Arial, sans-serif;
    background-color: #f0f0f0;
    color: #333;
    line-height: 1.6;
}

.registration-header {
    font-size: 40px;
    font-weight: bold;
    margin-top: 30px;
    text-align: center;
    color: #2c3e50;
    margin-bottom: 40px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.books__form {
    width: 350px;
    margin: 80px auto 160px;
    text-align: center;
    background-color: #fff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.books__form-input {
    width: 100%;
    font-size: 18px;
    background-color: #ecf0f1;
    color: #333;
    padding: 12px 20px;
    border: 1px solid #bdc3c7;
    border-radius: 5px;
    margin: 8px 0;
    transition: border-color 0.3s ease;
}

.books__form-input:focus {
    outline: none;
    border-color: #3498db;
}

.books__form-input::placeholder {
    color: #95a5a6;
}

.books__form-button {
    background-color: #3498db;
    padding: 14px 20px;
    color: #fff;
    width: 100%;
    font-size: 18px;
    font-weight: 700;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.books__form-button:hover {
    background-color: #2980b9;
}

.logout {
    background-color: #e74c3c;
    color: #fff;
    padding: 14px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: all 0.3s ease;
    width: 100%;
    font-size: 18px;
    font-weight: 700;
    margin-top: 20px;
}

.logout:hover {
    background-color: #c0392b;
}

th {
    color: #3498db;
    font-weight: 700;
}

table {
    box-sizing: border-box;
    border-collapse: collapse;
    width: 100%;
    margin-top: 30px;
    border: 1px solid #ddd;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

th,
td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: center;
    color: #333;
}

th {
    background-color: #ecf0f1;
}
    </style>
</head>
<body>
    <div class="registration-header">Админ панель</div>
    
    <form class='books__form' action='delete_user.php' method='post'>
        <input type='text' class='books__form-input' name='id' placeholder='ID пользователя'>
        <input type='submit' class='books__form-button' value='Удалить'>
    </form>

    <form class='books__form' action='edit_user.php' method='post'>
        <input type='text' class='books__form-input' name='id' placeholder='ID пользователя'>
        <input type='text' class='books__form-input' name='login' placeholder='Новый логин'>
        <input type='text' class='books__form-input' name='password' placeholder='Новый пароль'>
        <input type='text' class='books__form-input' name='email' placeholder='Новый email'>
        <input type='submit' class='books__form-button' value='Редактировать'>
    </form>

    <form method="post" action="authindex.php">
        <input type="submit" class="logout" name="logout" value="На главную">
    </form>

    <?php
    require_once __DIR__ . "/config/db.php";

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    session_start();
    if (!$_SESSION['authorized']) {
        header('Location: index.php');
        exit;
    }
    $sql = "SELECT id, login, password, email FROM users";
    $result = $conn->query($sql);
    if ($_SESSION['username'] != "Brusnik") {
        header('Location: index.php');
        exit;
    }
    echo "<table>";
    echo "<tr><th>ID</th><th>Login</th><th>Password</th><th>Email</th></tr>";
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["id"] . "</td><td>" . $row["login"] . "</td><td>" . $row["password"] . "</td><td>" . $row["email"] . "</td></tr>";
        }
    } else {
        echo "0 results";
    }
    echo "</table>";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["logout"])) {
            session_unset();
            session_destroy();
            header("Location: main.php");
            exit;
        }
    }
    $conn->close();
    ?> 
</body>
</html>
