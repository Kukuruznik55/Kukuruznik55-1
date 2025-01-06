<?php 
require_once __DIR__ . "/config/db.php";

if ($conn->connect_error) {
    die("Ошибка соединения: " . $conn->connect_error);
}

$errorMessage = "";
session_start();

$sql = "SELECT * FROM users WHERE login='{$_SESSION['username']}'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $login = $row["login"];
    $password = $row["password"];
    $email = $row["email"];

    if (!$_SESSION['authorized']) {
        header('Location: index.php');
        exit;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["logout"])) {
            session_unset();
            session_destroy();
            header("Location: index.php");
            exit;
        }
        $newPassword = $conn->real_escape_string($_POST["new_password"]);
        $userid = $row['id'];

        $sql = "UPDATE users SET password = '$newPassword' WHERE id = '$userid'";
        if ($conn->query($sql) === TRUE) {
            $successMessage = "Пароль успешно обновлен";
        } else {
            $errorMessage = "Ошибка обновления пароля: " . $conn->error;
        }
    }
} else {
    $errorMessage = "Ошибка получения данных пользователя";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/person.css"> <!-- Подключение CSS файла -->
    <title>Личный кабинет</title>
</head>
<body>

<?php require_once __DIR__ . "/incs/authheader.php" ?>

<section class="person">
    <div class="person__title">
        Личный кабинет
    </div>

    <div class="person__info">
        <div class="person__info-info">
            <div class="person__info-info-title">
                Информация о пользователе
            </div>
            <div class="person__info-info-login">
                Логин: <span><?php echo $row["login"]; ?></span>
            </div>
            <div class="person__info-info-email">
                E-mail: <span><?php echo $row["email"]; ?></span>
            </div>
            <div class="person__info-info-pass">
                Пароль: <span>******</span> <!-- Не показывайте пароль -->
            </div>
        </div>

        <div class="person__repass">
            <div class="person__repass-title">
                Изменить пароль
            </div>
            <div class="person__repass-repass">
                <form class="person__repass-repass-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <input class="repass-input" type="password" id="new_password" name="new_password" placeholder="Новый пароль">
                    <input class="repass-btn" type="submit" value="Изменить пароль">
                </form>
            </div>
        </div>
    </div>

    <div class="person__logOut">
        <form method="post" action="">
            <input type="submit" class="logout" name="logout" value="Выйти из аккаунта">
        </form>
    </div>
</section>

<?php require_once __DIR__ . "/incs/footer.php" ?>
</body>
</html>
