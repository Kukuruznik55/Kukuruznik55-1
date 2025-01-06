<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = htmlspecialchars($_POST["fullname"]);
    $username = htmlspecialchars($_POST["username"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $birthdate = $_POST["birthdate"];

    // Здесь можно подключить базу данных и сохранить данные пользователя
    // Для примера выводим сообщение на экран
    echo "
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .message-container {
            background-color: #fff;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
        }
        h1 {
            color: #28a745;
        }
    </style>
    <div class='message-container'>
        <h1>Регистрация завершена!</h1>
        <p><strong>ФИО:</strong> $fullname</p>
        <p><strong>Логин:</strong> $username</p>
        <p><strong>Дата рождения:</strong> $birthdate</p>
    </div>
    ";
}
?>
