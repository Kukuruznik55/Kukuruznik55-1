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
} else {
    $errorMessage = "Ошибка получения данных пользователя";
}
if (!isset($_SESSION['authorized']) || !$_SESSION['authorized']) {
    header('Location: index.php');
    exit;
}

// Получаем данные о книгах из базы данных
$sql_books = "SELECT * FROM content";
$result_books = $conn->query($sql_books);

// Проверка, является ли пользователь администратором
$isAdmin = ($login == "Brusnik");

// Обработка добавления новой книги
if ($isAdmin && isset($_POST['add_book'])) {
    $title = $_POST['book_title'];
    $image = $_POST['book_image'];
    $link = $_POST['book_link'];

    $sql_insert = "INSERT INTO content (title, image, link) VALUES ('$title', '$image', '$link')";
    if ($conn->query($sql_insert) === TRUE) {
        header('Location: authbooks.php');
        exit();
    } else {
        $errorMessage = "Ошибка добавления проблемы " . $conn->error;
    }
}

// Обработка удаления книги
if ($isAdmin && isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql_delete = "DELETE FROM content WHERE id = $delete_id";
    if ($conn->query($sql_delete) === TRUE) {
        header('Location: authbooks.php');
        exit();
    } else {
        $errorMessage = "Ошибка удаления проблемы " . $conn->error;
    }
}
?>

<?php require_once __DIR__ . "/incs/authheader.php" ?>

<section class="books__title">
    <div class="container">
        Проблемы
    </div>
</section>

<div class="books__books">
    <div class="container">
        <div class="books__cards">
            <?php
            if ($result_books->num_rows > 0) {
                while ($row_book = $result_books->fetch_assoc()) {
                    echo '<div class="books__card">';
                    echo '<div class="books__card-img">';
                    echo '<img src="' . $row_book["image"] . '" alt="' . $row_book["title"] . '">';
                    echo '</div>';
                    echo '<div class="books__card-title">';
                    echo $row_book["title"];
                    echo '</div>';
                    echo '<div class="books__card-price">';
                    echo 'Смотреть можно здесь';
                    echo '</div>';
                    echo '<div class="books__card-button">';
                    echo '<a href="' . $row_book["link"] . '" target="_blank">Смотреть</a>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "Нет доступных проблем.";
            }
            ?>
        </div>
    </div>
</div>

<?php if ($isAdmin) : ?>
    <section class="admin-panel">
        <div class="container">
            <h2>Админ-панель</h2>
            <?php if (!empty($errorMessage)) : ?>
                <div class="error-message"><?= $errorMessage ?></div>
            <?php endif; ?>
            <table class="admin-table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Изображение</th>
                    <th>Ссылка</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $sql_books_admin = "SELECT * FROM content";
                $result_books_admin = $conn->query($sql_books_admin);

                if ($result_books_admin && $result_books_admin->num_rows > 0) {
                    while ($row_book = $result_books_admin->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row_book['id'] . "</td>";
                        echo "<td>" . $row_book['title'] . "</td>";
                        echo "<td>" . $row_book['image'] . "</td>";
                        echo "<td>" . $row_book['link'] . "</td>";
                        echo "<td><a href='authbooks.php?delete_id=" . $row_book['id'] . "' onclick='return confirm(\"Вы уверены, что хотите удалить эту книгу?\")'>Удалить</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Нет доступных проблем.</td></tr>";
                }
                ?>
                </tbody>
            </table>

            <h3>Добавить новую проблему</h3>
            <form action="authbooks.php" method="post" class="admin-form">
                <input type="text" name="book_title" placeholder="Название проблемы" required>
                <input type="text" name="book_image" placeholder="Ссылка на изображение" required>
                <input type="text" name="book_link" placeholder="Ссылка на страницу" required>
                <button type="submit" name="add_book">Добавить</button>
            </form>
        </div>
    </section>
<?php endif;
$conn->close();
?>

<?php require_once __DIR__ . "/incs/footer.php" ?>
</body>
</html>
<style>
body {
    font-family: sans-serif;
    margin: 0;
    padding: 0;
    background-color: #F9E79A; /* Ярко-желтый фон */
    color: #000; /* Черный текст */
}

.container {
    width: 80%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 15px;
}

.books__title {
    background-color: #FFD700; /* Яркий желтый */
    color: #000; /* Черный текст */
    text-align: center;
    padding: 20px 0;
    font-size: 2em;
    font-weight: bold;
}

.books__cards {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
    padding: 20px 0;
}

.books__card {
    background-color: #F0E68C; /* Светло-желтый фон */
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    display: flex;
    flex-direction: column;
    width: 300px;
    border: 1px solid #FFD700;
}

.books__card-img {
    overflow: hidden;
    height: 200px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.books__card-img img {
    width: 100%;
    object-fit: cover;
}

.books__card-title {
    padding: 15px;
    font-weight: bold;
    text-align: center;
    background-color: #F0E68C; /* Светло-желтый */
     color: #000;
}

.books__card-price {
    padding: 15px;
    text-align: center;
    color: #000;
}

.books__card-button {
    padding: 15px;
    text-align: center;
}

.books__card-button a {
    display: inline-block;
    padding: 10px 20px;
    background-color: #FFD700; /* Яркий желтый */
    color: #000; /* Черный текст */
    text-decoration: none;
    border-radius: 5px;
}

.books__card-button a:hover {
    background-color: #E6B800; /* Темно-желтый */
}

.admin-panel {
    background-color: #E6B800;  /* Темно-желтый фон */
    color: #000;
    padding: 20px 0;
}

.admin-panel h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #000;
}

.admin-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

.admin-table th, .admin-table td {
    border: 1px solid #FFD700; /* Яркий желтый */
    padding: 8px;
    text-align: left;
    color: #000;
}

.admin-table th {
    background-color: #F0E68C; /* Светло-желтый */
    color: #000;
}

.admin-table tr:nth-child(even) {
    background-color: #F0E68C;
}

.admin-table a {
    color: #FFD700; /* Яркий желтый */
    text-decoration: none;
}

.admin-table a:hover {
    text-decoration: underline;
}

.admin-form {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.admin-form input, .admin-form button {
    padding: 10px;
    border: 1px solid #FFD700; /* Яркий желтый */
    background-color: #F0E68C; /* Светло-желтый */
    color: #000;
}

.admin-form button {
    cursor: pointer;
}
.error-message {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 4px;
    text-align: center;
}
</style>