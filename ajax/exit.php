<?php
    setcookie('log', '', time() - 3600, '/');
    unset($_COOKIE['log']);
    echo 'Exit';