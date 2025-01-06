<?php 
require_once __DIR__ . "/config/db.php";

$id = $_POST['id'];
if($id == 1) {
  echo "Ты че, не трогай его";
} else {
  $sql = "DELETE FROM users WHERE id=$id";

  if ($conn->query($sql) === TRUE) {
    header('Location:admin.php');
  } else {
    echo "Error deleting record: " . $conn->error;
  }
}
$conn->close();
?>