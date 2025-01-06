<?php require_once __DIR__ . "/incs/header.php"; $title = 'Проблемы'; ?> 

<section class="books__title"> 
    <div class="container"> 
        Проблемы в жизни 
    </div> 
</section>
<style>
    .books__card-img img {
        width: 600px; /* Установите желаемую ширину */
        height: 400px; /* Установите желаемую высоту */
        object-fit: cover; /* Сохраняет пропорции изображения и обрезает его, если необходимо */
    }
</style>
<div class="books__books">
    <div class="container">
        <div class="books__cards">

            <div class="books__card">
                <div class="books__card-img">
                    <img src="img/main/relationship.jpg" alt="">
                </div>
                <div class="books__card-title">
                    Созависимые отношения
                </div>
                <div class="books__card-button">
                    <a onclick="showErrorMessage()">Смотреть</a>
                </div>
            </div>

            <div class="books__card">
                <div class="books__card-img">
                    <img src="img/main/sun.jpg" alt="">
                </div>
                <div class="books__card-title">
                    Как воспитать сына
                </div>
                <div class="books__card-button">
                    <a onclick="showErrorMessage()">Смотреть</a>
                </div>
            </div>
            <div class="books__card">
                <div class="books__card-img">
                    <img src="img/main/food.jpg" alt="">
                </div>
                <div class="books__card-title">
                    Как избавиться от переедания
                </div>
                <div class="books__card-button">
                    <a onclick="showErrorMessage()">Смотреть</a>
                </div>
            </div>
            <div class="books__card">
                <div class="books__card-img">
                    <img src="img/main/care.jpg" alt="">
                </div>
                <div class="books__card-title">
                    Как научиться ухаживать за собой
                </div>
                <div class="books__card-button">
                    <a onclick="showErrorMessage()">Смотреть</a>
                </div>
            </div>
            <div class="books__card">
                <div class="books__card-img">
                    <img src="img/main/family.jpg" alt="">
                </div>
                <div class="books__card-title">
                    Как создать счастливую семью
                </div>
                <div class="books__card-button">
                    <a onclick="showErrorMessage()">Смотреть</a>
                </div>
            </div>

        </div>
    </div>
</div>

<?php require_once __DIR__ . "/incs/footer.php"; ?> 

<script> 
    function showErrorMessage() { 
        alert("Только авторизованные пользователи могут получить доступ."); 
    } 
</script> 

</body> 
</html>

