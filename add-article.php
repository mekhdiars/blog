<?php
    if (!isset($_COOKIE['log'])) {
        header("Location: /login.php");
    }
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <?php
        $websiteTitle = 'Добавить статью';
        include_once 'blocks/head.php';
    ?>
</head>
<body>
    <?php include_once "blocks/header.php"; ?>

    <main>
        <h1>Добавить статью</h1>
        <form class="title">
            <label for="title">Название статьи</label>
            <Input type="text" name="title" id="title">

            <label for="anons">Анонс статьи</label>
            <textarea name="anons" id="anons"></textarea>
            
            <label for="full_text">Основной текст</label>
            <textarea name="full_text" id="full_text"></textarea>

            <div class="error-mess" id="error-block"></div>

            <button type="button" id="add_article">Добавить</button>
        </form>
    </main>

    <?php include_once "blocks/aside.php" ?>
    <?php include_once "blocks/footer.php" ?>

    <script>
        $('#add_article').click(function() {
            let title = $('#title').val();
            let anons = $('#anons').val();
            let full_text = $('#full_text').val();

            $.ajax({
                url: 'ajax/add_article.php',
                type: 'POST',
                cache: false,
                data: {
                    'title': title,
                    'anons': anons,
                    'full_text': full_text
                },
                dataType: 'html',
                success: function(data) {
                    if (data === 'Done') {
                        $('#add_article').text('Все готово');
                        $('#error-block').hide();
                        $('#title').val('');
                        $('#anons').val('');
                        $('#full_text').val('');
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