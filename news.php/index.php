<?php

include "../database.php"; //подключение db "techart_news"

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News: Lenta</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
    if (isset($_GET['page'])) { //проверка существует ли $page
        $page = $_GET['page']; 
    } else {
        $page = 1; //если значение не существует, устанавливается значение по умолчанию
    }

    $request_count = mysqli_query($link, "SELECT COUNT(*) FROM  news");
    $get_count_articles = mysqli_fetch_array($request_count); // выбирает строку из результата в виде числового массива 
    $all_pages = $get_count_articles[0]; //количество страниц в массиве
    $pages_on_screen = 5; //количество статей на странице
    $count_pages = ceil(($all_pages - 1) / $pages_on_screen); //
    $shift_pages = ($page - 1) * $pages_on_screen; // определение смещения страниц
    $sql = "SELECT * FROM news
                     ORDER BY idate DESC
                     LIMIT $shift_pages, $pages_on_screen"; // запрос в таблицу news
    $response_data = mysqli_query($link, $sql); //запрос на выборку данных из db
?>

    <div class="container">
    
        <div class="header">
            <h1>Новости</h1>
        </div>

        <div class="content">
            <div class="news_line">

                <?php
                    while ($row = mysqli_fetch_array($response_data)) { // выбирает строку из результата в виде ассициативного массива
                    $current_date = gmdate("d.m.Y", $row['idate']); // записываем дату в переменную, пока выполняется цикл
                ?>

                <div class="news_header">

                    <div class="current_date">
                         <div><?php echo $current_date; ?></div> <!-- отображает дату статьи на странице -->
                    </div>

                    <div class="news_title">
                        <a href="http://news/view.php?id=<?php echo $row['id']; ?>"> <!-- отображает ссылку на статью -->
                            <?php echo $row['title']; ?> <!-- отображает заголовок статьи -->
                        </a>
                    </div>
                </div>

                <div class="news_content">
                    <?php echo $row['announce']; ?> <!-- отображает краткое содержание статьи -->
                </div>

                <?php } ?>

            </div>         
        </div>

        <div class="footer">
                <h3>Страницы:</h3>

                <?php for ($p = 0; $p <= $count_pages; $p++) { 
                
                ?>

                <a href="?page=<?php echo $p + 1; ?>" class="pagination">
                        <button class="numbers <?php
                                                $active = $p + 1 == $page ? 'active' : ''; // добавление класса active на выбрвнную страницу
                                                echo $active
                                                ?>
                                                " type="button" data-id = "<?=$p+1?>" ><?php echo $p + 1; ?>
                        </button>
                </a>
                    
                <?php } ?>
                                   
        </div>
    </div>

</body>
</html>