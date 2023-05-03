<?php

include "../database.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News: Article</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
</head>
<body>

    <?php

        $page = $_GET['id'];
        $query = mysqli_query($link, "SELECT * FROM `news` WHERE id = $page");
        $note = mysqli_fetch_assoc($query);

    ?>

    <main class="content">
        <section class="header">
            <h1><?php echo $note['title']; ?></h1>
        </section>

        <section class="article">
            <div class="article_content">
                <?php echo $note['content']; ?>
            </div>
        </section>

        <footer class="footer">
            <a href="http://news/news.php">Все новости &gt;&gt;</a>
        </footer>
    </main>
    
</body>
</html>