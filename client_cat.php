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
    <link rel="stylesheet" href="style/client_cat.css">
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

            <div class="main-inner-head">
                <h2>Izvēlies ēdiena kategoriju</h2>
            </div>

            <div class="main-inner-cat">
                <?php $PublicCategory = false; ?>
                <?php foreach ($categories as $cat): ?>
                    <?php if (isset($cat['category_public']) && $cat['category_public'] === 1): ?>

                        <div class="main-inner-cat-item">
                            <div class="main-inner-cat-item-img">
                                
                                <a href="client_food.php?category_id=<?php echo htmlspecialchars($cat['id']); ?>">
                                    <img src="<?php echo htmlspecialchars($cat['cat_image']); ?>" alt="">
                                </a>
                                
                            </div>
                            <div class="main-inner-cat-item-text">
                                <h2><?php echo htmlspecialchars($cat['category_name']) ?></h2>
                            </div>
                        </div>

                        <?php $PublicCategory = true; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
                <?php if (!$PublicCategory): ?>
                    <p>Nav pieejamas kategorijas</p>
                <?php endif; ?>
            </div>

        </div>
    </div>



    
</body>

<script src="scripts/client.js"></script>

</html>