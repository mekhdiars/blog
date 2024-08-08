<!DOCTYPE html>
<html lang="ru">
<head>
    <?php
    $websiteTitle = 'Регистрация';
    include_once 'blocks/head.php';
    ?>
</head>
<body>
    <?php include_once "blocks/header.php" ?>

    <main>
        <h1>Регистрация</h1>
        <form class="user">
            <label for="username">Имя</label>
            <input type="username" name="username" id="username">
            
            <label for="email">Email</label>
            <Input type="email" name="email" id="email">
            
            <label for="password">Пароль</label>
            <Input type="password" name="password" id="password"><br>

            <div class="error-mess" id="error-block"></div>

            <button type="button" id="reg_user">Зарегистрироваться</button>
            
        </form>
    </main>

    <?php include_once "blocks/aside.php" ?>
    <?php include_once "blocks/footer.php" ?>
    <script>
        $('#reg_user').click(function() {
            let name = $('#username').val();
            let email = $('#email').val();
            let password = $('#password').val();

            $.ajax({
                url: 'ajax/reg.php',
                type: 'POST',
                cache: false,
                data: {
                    'name': name,
                    'email': email,
                    'password': password
                },
                dataType: 'html',
                success: function(data) {
                    if (data === 'Done') {
                        $('#reg_user').text('Все готово');
                        $('#error-block').hide();
                        window.location.href = 'login.php';

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