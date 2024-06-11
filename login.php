<?php

include "api/post_request.php";

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/login.css">
    <title>Login</title>
</head>
<body>
    <div class="main">
        <div class="login">
            <h1>Pieslēgties</h1>
            <form method="post" onsubmit="return validateFormLogin()">
                <div>
                    <?php if(isset($_POST['action']) && $_POST['action'] === 'loginUser' && isset($errorMessage)): ?>
                        <p class="error-message"><?php echo $errorMessage; ?></p>
                    <?php endif; ?>
                    <input type="text" id="username" name="username" placeholder="Lietotājvārds">
                    <p id="username-error" class="error-message"></p>
                    <input type="password" id="password" name="password" placeholder="Parole">
                    <p id="password-error" class="error-message"></p>
                </div>
                <div>
                    <input type="hidden" name="action" value="loginUser">
                    <button type="submit">Pieslēgties</button>
                </div>
            </form>
            <p>Nav izveidots konts? <a href="register.php">Reģistrējies šeit</a></p>
        </div>
    </div>
</body>
<script src="scripts/login.js"></script>
</html>

