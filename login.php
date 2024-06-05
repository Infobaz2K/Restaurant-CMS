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
            <form method="post">
                <div>
                    <input type="text" id="username" name="username" placeholder="Lietotājvārds"><br>
                    <input type="password" id="password" name="password" placeholder="Parole"><br>
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
</html>

