<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/icon/fav.ico">
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
               
                <nav class="nav-main">
                    <ul class="nav-main__list">
                        <li class="nav-main__item">
                            <a class="nav-main__link" href="authindex.php">Главная</a>
                        </li>
                        <li class="nav-main__item">
                            <a class="nav-main__link" href="authbooks.php">Проблемы</a>
                        </li>
                        <li class="nav-main__item">
                            <a class="nav-main__link" href="admin.php">Управление</a>
                        </li>
                    </ul>
                </nav>
                <a class="btn-primary header__btn" href="person.php">Личный кибинет</a>
            </div>
            <div class="header1">
                <div class="header1-logo">
                    <a href=""><img class="header1-logo__img" src="img/main/log.jpg" alt="logo"></a>
                </div>
                <div class="dropdown">
                    <button onclick="myFunction()" class="dropbtn">Меню</button>
                    <div id="myDropdown" class="dropdown-content">
                      <a href="authindex.php">Главная</a>
                      <a href="authbooks.php">Проблемы</a>
                    </div>
                  </div>
                  <a class="btn-primary1 header__btn1" href="person.php">Личный кибинет</a>
            </div>
        </div>
    </header>