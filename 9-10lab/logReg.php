<?php 
session_start();
require_once __DIR__ . "/config/db.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['register'])) {
      $login = $_POST['login'];
      $password = $_POST['password'];
      $email = $_POST['email'];

      
      $checkUserQuery = "SELECT * FROM users WHERE login='$login' OR email='$email'";
      $checkUserResult = $conn->query($checkUserQuery);
      if ($checkUserResult->num_rows > 0) {
          echo '<script>alert("Такой пользователь уже существует")</script>';
      } else {
          $insertQuery = "INSERT INTO users (login, password, email) VALUES ('$login', '$password', '$email')";
          if ($conn->query($insertQuery) === TRUE) {
            $_SESSION['authorized'] = true; 
              echo '<script>alert("Регистрация прошла успешно");</script>';
          } else {
              echo "Ошибка при регистрации: " . $conn->error;
          }
      }
  }
  if (isset($_POST['loggin'])) {
      $login = $_POST['login'];
      $password = $_POST['password'];
      $sql = "SELECT * FROM users WHERE login = '$login' AND password = '$password'";
      $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $login;
        $_SESSION['password'] = $password;
        $_SESSION['email'] = $email; 
        session_start();
        $_SESSION['authorized'] = true;
        header('Location: person.php');
        exit;
    } else {
        $errorMessage = "Неверный логин или пароль";
    }
} 

}
$conn->close();
?>
  


  <?php require_once __DIR__ . "/incs/header.php"; ?>


<div class="registration-form">
  <?php if (!isset($_POST['loginForm'])) { ?>
    <form class="logReg__form" method="POST" action="">
      <input class="logReg__form-input" type="text" name="login"  placeholder="Логин" required><br><br>
      <input class="logReg__form-input" type="password" name="password"  placeholder="Пароль" required><br><br>
      <input class="logReg__form-input" type="email" name="email"  placeholder="Email" required><br><br>
      <button class="logReg__form-button" name="register">Зарегистрироваться</button><br><br>
      <p class="logReg__form-link">Уже зарегистрированы? <a href="#" onclick="showLoginForm()">Войти</a></p>
    </form>
  <?php } elseif (isset($_POST['loginForm'])) { ?>
    <form method="POST" action="">
      <input type="text" name="login2" placeholder="Логин" class="logReg__form-input" required><br><br>
      <input type="password" name="password2" placeholder="Пароль" class="logReg__form-input" required><br><br>
      <button class="logReg__form-button" name="loggin">Войти</button><br><br>
      <p class="logReg__form-link">Нет аккаунта? <a href="#" onclick="showRegistrationForm()">Зарегистрироваться</a></p>
    </form>
  <?php } ?>
</div>


<script>
  function showLoginForm() {
    var registrationForm = document.querySelector(".registration-form");
    registrationForm.innerHTML = `
      <form class="logReg__form" method="POST" action="">
        <input type="text" name="login" placeholder="Логин" class="logReg__form-input" required><br><br>
        <input type="password" name="password" placeholder="Пароль" class="logReg__form-input" required><br><br>
        <button class="logReg__form-button" name="loggin">Войти</button><br><br>
        <p class="logReg__form-link">Нет аккаунта? <a href="#" onclick="showRegistrationForm()">Зарегистрироваться</a></p>
      </form>
    `;
  }
  function showRegistrationForm() {
    var registrationForm = document.querySelector(".registration-form");
    registrationForm.innerHTML = `
      <form class="logReg__form" method="POST" action="">
        <input type="text" name="login" placeholder="Логин" class="logReg__form-input" required><br><br>
        <input type="password" name="password" placeholder="Пароль" class="logReg__form-input" required><br><br>
        <input type="mail" name="email" placeholder="Email" class="logReg__form-input" required><br><br>
        <button class="logReg__form-button" name="register">Зарегистрироваться</button><br><br>
        <p class="logReg__form-link">Уже зарегистрированы? <a href="#" onclick="showLoginForm()">Войти</a></p>
      </form>
    `;
  }
</script>



<?php
  if (isset($errorMessage)) {
      echo '<script>alert("Неверный логин или пароль");</script>';
  }
?>
<?php require_once __DIR__ . "/incs/footer.php"; ?>
</body>
</html>
