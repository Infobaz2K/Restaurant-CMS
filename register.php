<?php

include "api/post_request.php";

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/register.css">
    <title>User Registration</title>

</head>
<body>
    <div class="main">
        <div class="register">
            <h1>Lietotāja reģistrācija</h1>
            <form method="post">
                <div>
                    <input type="text" name="username" placeholder="Lietotājvārds"><br>
                    <input type="password" name="password" placeholder="Parole"><br>
                </div>
                <div>
                    <input type="hidden" name="action" value="registerUser">
                    <button type="submit">Reģistrēties</button>
                </div>
            </form>
            <p>Ir jau lietotāja konts izveidots? <a href="login.php">Pieslēdzies šeit</a></p>
        </div>
    </div>
</body>
</html>
