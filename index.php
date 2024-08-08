<!DOCTYPE html>
<html lang="ru">
<head>
    <?php
    $websiteTitle = 'Blog ARS';
    include_once 'blocks/head.php';
    ?>
</head>
<body>
    <?php
        $location = '/';
        include_once "blocks/header.php";
    ?>

    <main>
        <?php
            // echo '<pre>' . print_r($article, true) . '</pre>';
            
            include_once 'lib/mysql.php';

            $query = $pdo->query('SELECT * FROM articles ORDER BY date DESC');

            while($row = $query->fetch(PDO::FETCH_OBJ)) : 
        ?>
                <div class='post'>
                    <h2><?= $row->title ?></h2>
                    <p class="anons"><?= $row->anons ?></p>
                    <p class="avtor"><b>Автор: </b><span><?= $row->avtor ?></span></p>
                    <a href="/post.php?id=<?= $row->id ?>">Прочитать</a><br><hr>
                </div>
        <?php endwhile; ?>
    </main>

    <?php include_once "blocks/aside.php" ?>

    <?php include_once "blocks/footer.php" ?>
</body>
</html>