<?php
session_start();
require_once 'config/db.php';

if (isset($_SESSION['user_id'])) {
    $stmt = $pdo->prepare("SELECT login FROM users WHERE id = :user_id"); 
    $stmt->execute(['user_id' => $_SESSION['user_id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $username = isset($user['login']) ? $user['login'] : ''; 
} else {
    $username = '';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/main/i.jpg">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/logReg.css">
    <link rel="stylesheet" href="css/books.css">
    <link rel="stylesheet" href="css/person.css">
    <title><?=$title ?? 'Books' ?></title>
</head>
<body>
<header id="header-section">
        <div class="container">
            <div class="header">
                <div class="header-logo">
                    <a href="index.php"><img class="header-logo__img" src="img/main/logo.jpg" alt="logo"></a>
                </div>
                <nav class="nav-main">
                    <ul class="nav-main__list">
                        <li class="nav-main__item">
                            <a class="nav-main__link" href="index.php">Главная</a>
                        </li>
                        <li class="nav-main__item">
                            <a class="nav-main__link" href="problems.php">Проблемы</a>
                        </li>
                    </ul>
                </nav>
                <a class="btn-primary header__btn" href="logReg.php">Авторизация/Регистрация</a>
            </div>
            <div class="header1">
                <div class="header1-logo">
                    <a href=""><img class="header1-logo__img" src="img/main/i.jpg" alt="logo"></a>
                </div>
                <div class="dropdown">
                    <button onclick="myFunction()" class="dropbtn">Меню</button>
                    <div id="myDropdown" class="dropdown-content">
                      <a href="index.php">Главная</a>
                      <a href="allCars">Проблемы</a>
                    </div>
                  </div>
                  <a class="btn-primary1 header__btn1" href="logReg.php">Авторизация/Регистрация</a>
            </div>
        </div>
    </header>