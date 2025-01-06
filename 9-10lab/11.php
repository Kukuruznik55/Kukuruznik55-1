if (isset($_POST["logout"])) {
            session_start();
            session_unset();
            session_destroy(); 
            header("Location: index.php");
            exit();
        }


        <form method="post" action="">
    
        <input type="submit" class="logout" name="logout" value="Выйти из аккаунта">
    </form>