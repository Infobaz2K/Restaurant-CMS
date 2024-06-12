<?php
session_start();

include 'api/post_request.php';
include 'api/get_request.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style/user_page.css">
    <link rel="stylesheet" data-purpose="Layout StyleSheet" title="Web Awesome" href="/css/app-wa-462d1fe84b879d730fe2180b0e0354e0.css?vsn=d">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/all.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-thin.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-solid.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-regular.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-light.css">
    <title>User Page</title>
</head>
<body>

    <div id="headerContainer"></div>

    <div class="main">

        <div class="main-buttons">
            <div class="main-buttons-inner">
                <a href="user_page.php" class="active">Uzņēmuma informācija</a>
                <div class="button-line"></div>
                <a href="user_menu.php">Ēdienkartes</a>
            </div>
        </div>

        <div class="main-inner">
            <div class="post-container">
                <?php $found = false; ?>
                <?php foreach ($posts as $post): ?>
                        <div class="post-info">
                            <form method="POST" onsubmit="return validateFormInfoEdit()">
                                <div class="post-info-col">
                                    <div class="post-info-col-1">
                                        <p>Uzņēmuma nosaukums:</p>
                                        <input type="text" id="businessname" name="businessname" value="<?php echo htmlspecialchars($post['businessname'] ?? ''); ?>">
                                        <p id="businessname-error" class="error-message"></p>
                                        <p>Reģistrācijas nummurs:</p>
                                        <input type="text" id="regnum" name="regnum" value="<?php echo htmlspecialchars($post['regnum'] ?? ''); ?>">
                                        <p id="regnum-error" class="error-message"></p>
                                        <p>Juridiskā adrese:</p>
                                        <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($post['address'] ?? ''); ?>">
                                        <p id="address-error" class="error-message"></p>
                                    </div>
                                    <div class="post-info-col-2">
                                        <p>Banka:</p>
                                        <input type="text" id="bank" name="bank" value="<?php echo htmlspecialchars($post['bank'] ?? ''); ?>">
                                        <p id="bank-error" class="error-message"></p>
                                        <p>SWIFT:</p>
                                        <input type="text" id="swift" name="swift" value="<?php echo htmlspecialchars($post['swift'] ?? ''); ?>">
                                        <p id="swift-error" class="error-message"></p>
                                        <p>Konta nummurs:</p>
                                        <input type="text" id="bankaccnum" name="bankaccnum" value="<?php echo htmlspecialchars($post['bankaccnum'] ?? ''); ?>">
                                        <p id="bankaccnum-error" class="error-message"></p>
                                    </div>
                                </div>

                                <input type="hidden" name="action" value="editInfo">

                            </form>

                            <form id="autoPostImage" method="POST" enctype="multipart/form-data">
                                <div class="post-info-img">
                                    <p>Uzņēmuma logo:</p>
                                    <input type="file" id="post_image" name="post_image" accept=".jpg, .jpeg, .png">
                                    <label for="post_image">
                                        <?php if (!empty($post['post_image'])): ?>
                                            <div class="post-info-img-box"><img src="<?php echo $post['post_image']; ?>"></div>
                                        <?php else: ?>
                                            <p>Nav uzņēmuma logo</p>
                                        <?php endif; ?>
                                    </label>
                                    <span id="file-name">Klikšķiniet uz logo, lai nomainītu</span>
                                </div>
                                <input type="hidden" name="action" value="editInfoImage">
                            </form>
                            
                            <div>
                                <button id="saveButton" type="submit">Saglabāt</button>
                                <a class="button" href="client_start.php?user_id=<?php echo $post['user_id']; ?>">Apskatīt klienta ēdienkarti</a>
                            </div>

                        </div>
                        <?php $found = true; ?>
                <?php endforeach; ?>

                <?php if (!$found): ?>
                    <div class="post-info">
                        <form method="POST" enctype="multipart/form-data" onsubmit="return validateFormInfoInsert()">
                            <div class="post-info-col">
                                <div class="post-info-col-1">
                                    <p>Uzņēmuma nosaukums:</p>
                                    <input type="text" id="businessname" name="businessname" value="">
                                    <p id="businessname-error" class="error-message"></p>
                                    <p>Reģistrācijas nummurs:</p>
                                    <input type="text" id="regnum" name="regnum" value="">
                                    <p id="regnum-error" class="error-message"></p>
                                    <p>Juridiskā adrese:</p>
                                    <input type="text" id="address" name="address" value="">
                                    <p id="address-error" class="error-message"></p>
                                </div>
                                <div class="post-info-col-2">
                                    <p>Banka:</p>
                                    <input type="text" id="bank" name="bank" value="">
                                    <p id="bank-error" class="error-message"></p>
                                    <p>SWIFT:</p>
                                    <input type="text" id="swift" name="swift" value="">
                                    <p id="swift-error" class="error-message"></p>
                                    <p>Konta nummurs:</p>
                                    <input type="text" id="bankaccnum" name="bankaccnum" value="">
                                    <p id="bankaccnum-error" class="error-message"></p>
                                </div>
                            </div>
                            <div class="post-info-img">
                                <p>Uzņēmuma logo:</p>
                                <input type="file" id="post_image" name="post_image" accept=".jpg, .jpeg, .png" value="">
                                <label for="post_image">
                                    <i class="fa-regular fa-cloud-arrow-up" style="color: #5e5e5e;"></i>
                                </label>
                                <span id="file-name">Izvēlies bildi</span>
                                <p id="image-error" class="error-message"></p>
                            </div>
                            <input type="hidden" name="action" value="postInfo">
                            <button type="submit">Pievienot <i class="fa-solid fa-arrow-right" style="color: #000000;"></i></button>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </div>

    <div id="footerContainer"></div>


</body>

<script src="scripts/user.js"></script>
</html>

