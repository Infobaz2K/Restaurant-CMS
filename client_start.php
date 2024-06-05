<?php
session_start();

include 'api/post_request.php';
include 'api/get_request.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/client_start.css">
    <title>Client Start</title>
</head>
<body>

    <div class="main">
        
        <img src="img/clientbg.jpeg" alt="">
        
        <div class="img-txt">
            <?php if (!empty($posts) && isset($posts[0])): ?>
                <?php $post = $posts[0]; ?>
                <div class="img-txt-image">
                    <?php if (!empty($post['post_image'])): ?>
                        <img src="<?php echo htmlspecialchars($post['post_image']); ?>" alt="">
                    <?php else: ?>
                        <p>Nav Ievietots Logo</p>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <div class="img-txt-image">
                    <p>Nav Ievietots Logo</p>
                </div>
            <?php endif; ?>

            <h1>ĀTRI, ĒRTI, GARŠĪGI</h1>

            <?php
            $activeMenu = null;
            foreach ($menus as $menu) {
                if (isset($menu['public']) && $menu['public'] == 1) {
                    $activeMenu = $menu;
                    break;
                }
            }
            if ($activeMenu): ?>
                <a href="client_cat.php?menu_id=<?php echo htmlspecialchars($activeMenu['id']); ?>">Apskatīt ēdienkarti</a>
            <?php else: ?>
                <p>Nav pieejama ēdienkarte</p>
            <?php endif; ?>

        </div>

    </div>
    
</body>

<script src="scripts/client.js"></script>

</html>