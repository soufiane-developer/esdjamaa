<style>
    .message-container {
        top: 20px;
        max-width: 60%;
        margin: 20px auto;
        padding: 10px;
        border-radius: 5px;
        font-size: 16px;
        position: absolute;
        left: 18%;
        width: 100%;
        z-index: 2;
    }

    .message-container div {
        display: flex;
        align-items: center;
        padding: 15px;
        opacity: .9;
        border-radius: 0.4rem;
        margin-bottom: 10px;
        transition: opacity 0.5s ease;
    }

    .message-container i {
        margin-right: 10px;
        font-size: 20px;
    }

    .message-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .message-success i {
        color: #28a745;
    }

    .message-error {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .message-error i {
        color: #dc3545;
    }

    .message-warning {
        background-color: #fff3cd;
        color: #856404;
        border: 1px solid #ffeeba;
    }

    .message-warning i {
        color: #ffc107;
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<?php
if (isset($message_success)) {
    foreach ($message_success as $message) {
        echo '    <div class="message-container">
<div class="message-success"><i class="fa-solid fa-square-check"></i> ' . $message . '</div></div>';
    }
}

if (isset($message_error)) {
    foreach ($message_error as $message) {
        echo '    <div class="message-container">
    <div class="message-error"><i class="fa-solid fa-square-check"></i> ' . $message . '</div></div>';
    }
}

if (isset($message_warning)) {
    foreach ($message_warning as $message) {
        echo '    <div class="message-container">
   <div class="message-warning"><i class="fa-solid fa-triangle-exclamation"></i> ' . $message . '</div></div>';
    }
}
?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const messages = document.querySelectorAll('.message-container div');

        messages.forEach(function (message) {

            setTimeout(function () {
                message.style.opacity = '0';

                setTimeout(function () {
                    message.remove();
                }, 500);
            }, 5000);
        });
    });
</script>