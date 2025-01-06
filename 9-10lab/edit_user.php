<?php 
require_once __DIR__ . "/config/db.php";

$id = $_POST['id'];
$login = $_POST['login'];
$password = $_POST['password'];
$email = $_POST['email'];
$sql = "UPDATE users SET login='$login', password='$password', email='$email' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
  header('Location:admin.php');
} else {
  echo "Error updating record: " . $conn->error;
}
$conn->close();
?>