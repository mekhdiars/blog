<header>
    <span class="logo">Blog ARS</span>
    <nav>
        <a href="/">Главная</a>
        <a href="/contacts.php">Контакты</a>
        <?php if (isset($_COOKIE['log'])) : ?>
            <a href="/users.php">Список пользователей</a>
            <a href="/add-article.php">Добавить статью</a>
            <a href="/login.php" class="btn">Кабинет пользователя</a>
        <?php else : ?>
            <a href="/login.php" class="btn">Войти</a>
            <a href="/register.php" class="btn">Регистрация</a>
        <?php endif; ?>
    </nav>

    <?php
    if ($websiteTitle === 'Список пользователей' || $websiteTitle === 'Добавить статью') {
        if (!isset($_COOKIE['log'])) {
            header("Location: /");
            exit();
        }
    }
    ?>

</header>