<!DOCTYPE html>
<html lang="ru">
<head>
    <?php
    $websiteTitle = 'Авторизация';
    include_once 'blocks/head.php';
    ?>
</head>
<body>
    <?php include_once "blocks/header.php" ?>

    <main>
        <?php if(!isset($_COOKIE['log'])): ?>
            <h1>Авторизация</h1>
            <form class="user">
                
                <label for="email">Email</label>
                <Input type="email" name="email" id="email">
                
                <label for="password">Пароль</label>
                <Input type="password" name="password" id="password"><br>

                <div class="error-mess" id="error-block"></div>

                <button type="button" id="login_user">Войти</button>
                
            </form>
        <?php else: ?>
            <h2><?= $_COOKIE['log'] ?></h2><br>
            <form>
                <button type="button" id="exit_user">Выйти</button>
            </form>
        <?php endif; ?>
    </main>

    <?php include_once "blocks/aside.php" ?>
    <?php include_once "blocks/footer.php" ?>
    <script>
        $('#login_user').click(function() {
            let email = $('#email').val();
            let password = $('#password').val();

            $.ajax({
                url: 'ajax/log.php',
                type: 'POST',
                cache: false,
                data: {
                    'email': email,
                    'password': password
                },
                dataType: 'html',
                success: function(data) {
                    if (data === 'Done') {
                        $('#login_user').text('Все готово');
                        $('#error-block').hide();
                        document.location.reload(true);
                    } else {
                        $("#error-block").show();
                        $("#error-block").text(data);
                    }
                }
            });
        });

        $('#exit_user').click(function() {
            $.ajax({
                url: 'ajax/exit.php',
                type: 'POST',
                cache: false,
                data: {},
                dataType: 'html',
                success: function(data) {
                    document.location.reload(true);
                }
            });
        });
    </script>
</body>
</html>