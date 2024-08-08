<!DOCTYPE html>
<html lang="ru">
<head>
    <?php
    include_once 'lib/mysql.php'; // подключение к БД

    $query = $pdo->prepare('SELECT * FROM articles WHERE id = ?');
    $query->execute([$_GET['id']]);

    $article = $query->fetch(PDO::FETCH_OBJ);

    $websiteTitle = $article->title;
    include_once 'blocks/head.php';
    ?>
</head>
<body>
    <?php include_once "blocks/header.php"; ?>

    <main>
        <!-- <?php echo '<pre>' . print_r($_GET['id'], true) . '</pre>'; ?> -->
        
        <div class='post'>
            <h2><?= $article->title ?></h2>
            <p class="anons"><?= $article->anons ?></p><br>
            <p class="full_text"><?= $article->full_text ?></p>
            <p class="avtor"><b>Автор: </b><span><?= $article->avtor ?></span></p><br>
            <p><?php echo '<b>Время публикации: </b>' . date("d. m. Y", $article->date) ?></p> 
        </div>

        <h2>Комментарии</h2>
        <form class="comments">
            <label for="username">Ваше имя</label>
                <input type="text" name="username" id="username" value="<?php if (isset($_COOKIE['log'])) echo $_COOKIE['log']; ?>">
            
            <label for="mess">Сообщение</label>
                <textarea name="mess" class="mess" id="mess"></textarea>

            <div class="error-mess" id="error-block"></div><br>

            <button type="button" id="mess_send">Добавить</button>
        </form><hr class="comments">

        <div class="comm">
        <?php
            $query = $pdo->prepare("SELECT * FROM comments WHERE article_id = ? ORDER BY id DESC");
            $query->execute([$_GET['id']]);
            
            $comments = $query->fetchAll(PDO::FETCH_OBJ);
            
            foreach($comments as $comment) :
        ?>
            <div class="comment">
                <p class="name"><?= $comment->name ?></p>
                <p class="mess"><?= $comment->mess ?></p>
            </div>
        <?php endforeach; ?>
        </div>
    </main>

    <?php include_once "blocks/aside.php" ?>
    <?php include_once "blocks/footer.php" ?>

    <script>
        $('#mess_send').click(function() {
            let name = $('#username').val();
            let mess = $('#mess').val();

            $.ajax({
                url: 'ajax/comment_add.php',
                type: 'POST',
                cache: false,
                data: {
                    'name': name,
                    'mess': mess,
                    'id': <?= $article->id ?>
                },
                dataType: 'html',
                success: function(data) {
                    if (data === 'Done') {
                        $('.comm').prepend(`<div class="comment">
                            <p class="name"> ${name} </p>
                            <p class="mess"> ${mess} </p>
                        </div>`);
                        $('#mess_send').text('Все готово');
                        $('#error-block').hide();
                        $('#mess').val('');
                    } else {
                        $("#error-block").show();
                        $("#error-block").text(data);
                    }
                }
            });
        });
    </script>
</body>
</html>