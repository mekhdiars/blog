<!DOCTYPE html>
<html lang="ru">
<head>
    <?php
    $websiteTitle = 'Список пользователей';
    include_once 'blocks/head.php';
    ?>
</head>
<body>
    <?php include_once "blocks/header.php" ?>

    <main>
        <h4>Список пользователей</h4>
        <?php
            include_once 'lib/mysql.php'; // подключение к БД
            $stmtUsers = $pdo->query("SELECT * FROM users ORDER BY id");
            $users = ($stmtUsers->fetchAll(PDO::FETCH_OBJ));
        ?>
        <div class="users">
            <?php foreach($users as $el) : ?>
                    <p class='user' id="<?= $el->id ?>">
                        <b>Имя: </b><?= $el->name . ', ' ?><b>Email: </b> <?= $el->email ?><button onclick="return deleteUser(<?= $el->id ?>)" class='user'>Удалить</button>
                    </p>
            <?php endforeach; ?>
        </div>
    </div>
    </main>
    <?php include_once "blocks/aside.php";
        include_once "blocks/footer.php"
    ?>

    <script>
        function deleteUser(id) {
            $.ajax({
                url: 'ajax/deleteUser.php',
                type: 'POST',
                cache: false,
                data: {'id': id},
                dataType: 'html',
                success: function(data) {
                    $(`#${id}`).remove();
                }
            })
        }
    </script>
</body>
</html>