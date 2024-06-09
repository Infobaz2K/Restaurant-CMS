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
    <link rel="stylesheet" href="style/client_food.css">
    <link rel="stylesheet" data-purpose="Layout StyleSheet" title="Web Awesome" href="/css/app-wa-462d1fe84b879d730fe2180b0e0354e0.css?vsn=d">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/all.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-thin.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-solid.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-regular.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-light.css">
    <title>Client Start</title>
</head>
<body>

    <div class="header">
        <div class="header-inner">
            <div class="header-inner-logo">
                <p>LOGO</p>
            </div>
            <div class="header-inner-text">
                <a class="active" href="">Ēdienkarte</a>
                <i class="fa-sharp fa-regular fa-bag-shopping" style="color: #000000;"></i>
            </div>
        </div>
    </div>

    <div class="main">
        <div class="main-inner">

        <div class="main-inner-back">
            <?php
                $back = $BackToCat[0];
                echo '<a href="client_cat.php?menu_id=' . $back['menu_id'] . '"><i class="fa-solid fa-arrow-left" style="color: #0d0d0d;"></i></a>';
            ?>
        </div>

            <div class="main-inner-cat">
                <?php $PublicFood = false; ?>
                <?php foreach ($foods as $food): ?>

                    <?php if (isset($food['food_public']) && $food['food_public'] == 1): ?>

                        <div class="main-inner-cat-item">
                            <a href="client_food_info.php?food_id=<?php echo htmlspecialchars($food['id']); ?>">
                                <div class="main-inner-cat-item-img">

                                    <img src="<?php echo htmlspecialchars($food['food_image']); ?>" alt="">
                                    
                                </div>
                                <div class="main-inner-cat-item-text">
                                    <div class="main-inner-cat-item-text-head">
                                        <h2><?php echo htmlspecialchars($food['food_name']) ?></h2>
                                    </div>
                                    <div class="main-inner-cat-item-text-desc">
                                        <p><?php echo htmlspecialchars($food['price']) ?>€</p>
                                        <p>•</p>
                                        <p><?php echo htmlspecialchars($food['cooktime']) ?></p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <?php $PublicFood = true; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
                <?php if (!$PublicFood): ?>
                    <p>Nav pieejami ēdieni</p>
                <?php endif; ?>
            </div>

        </div>
    </div>



    
</body>

<script src="scripts/client.js"></script>

</html>