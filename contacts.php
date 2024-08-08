<!DOCTYPE html>
<html lang="ru">
<head>
    <?php
        $websiteTitle = 'Контакты';
        include_once 'blocks/head.php';
    ?>
</head>
<body>
    <?php include_once "blocks/header.php"; ?>

    <main>
        <h1>Контакты</h1>
        <form class="title">
            <label for="username">Имя</label>
            <Input type="text" name="username" id="username">

            <label for="email">Email</label>
            <input type="email" name="email" id="email">
            
            <label for="mess">Сообщение</label>
            <textarea name="mess" id="mess"></textarea>

            <div class="error-mess" id="error-block"></div>

            <button type="button" class="mess_send" id="mess_send">Отпарвить</button>
        </form>
    </main>

    <?php include_once "blocks/aside.php" ?>
    <?php include_once "blocks/footer.php" ?>

    <script>
        $('#mess_send').click(function() {
            let name = $('#username').val();
            let email = $('#email').val();
            let mess = $('#mess').val();

            $.ajax({
                url: 'ajax/mail.php',
                type: 'POST',
                cache: false,
                data: {
                    'name': name,
                    'email': email,
                    'mess': mess
                },
                dataType: 'html',
                success: function(data) {
                    if (data === 'Done') {
                        $('#error-block').hide();
                        $('#username').val('');
                        $('#email').val('');
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