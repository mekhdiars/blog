<?php
    include_once 'lib/mysql.php';

    if (isset($_COOKIE['log'])) :
        $query = $pdo->query("SELECT * FROM chat ORDER BY id DESC");
        $messages = $query->fetchAll(PDO::FETCH_OBJ);

        if ($messages == false) :
?>
            <p class="empty_chat">Чат пока пустой</p>
        <?php else : ?>
        
            <div class="chat">
                <!-- Здесь будут отображаться сообщения чата -->
            </div>
        
        <?php endif; ?>

        <form>
            <input type="text" class="chat_mess" placeholder="Сообщение" id="chat_mess"><br>
            <div class="error-mess" id="error-block"></div><br>
            <button type="button" class="chat_mess" id="mess_send" onclick="return sendMess()">Отправить</button>
        </form>
    <?php endif ?>

    <script>
        function sendMess() {
            let mess = $('#chat_mess').val();
            
            $.ajax({
                url: 'ajax/add_message.php',
                type: 'POST',
                cache: false,
                data: {
                    'mess': mess
                },
                dataType: 'html',
                success: function(data) {
                    if(data === 'Done') {
                        $('#chat_mess').val('');
                    }
                }
            })

            fetchMessages(); // Вызов функции для получения и отображения сообщений
        };

        function fetchMessages() {
            $.ajax({
                url: 'ajax/fetch_messages.php',
                type: 'GET',
                cache: false,
                dataType: 'html',
                success: function(data) {
                    $('.chat').html(data); // Обновить интерфейс чата новыми сообщениями
                }
            });
        };

        // Установить интервал для получения и обновления сообщений каждые 3 секунды
        setInterval(function() {
            fetchMessages();
        }, 3000);
    </script>