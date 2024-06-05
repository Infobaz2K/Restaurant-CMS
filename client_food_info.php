<?php
// session_start();

include 'api/post_request.php';
include 'api/get_request.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/client_food_info.css">
    <link
      rel="stylesheet"
      data-purpose="Layout StyleSheet"
      title="Web Awesome"
      href="/css/app-wa-462d1fe84b879d730fe2180b0e0354e0.css?vsn=d"
    >

    <link
    rel="stylesheet"
    href="https://site-assets.fontawesome.com/releases/v6.5.1/css/all.css"
    >

    <link
    rel="stylesheet"
    href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-thin.css"
    >

    <link
    rel="stylesheet"
    href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-solid.css"
    >

    <link
    rel="stylesheet"
    href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-regular.css"
    >

    <link
    rel="stylesheet"
    href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-light.css"
    >
    <title>Client Start</title>
</head>
<body>

    <div class="header">
        <div class="header-inner">
            <div class="header-inner-logo">
                <p>LOGO</p>
            </div>
            <div class="header-inner-text">
                <a href="">Par mums</a>
                <a class="active" href="">Ēdienkarte</a>
                <i class="fa-sharp fa-regular fa-bag-shopping" style="color: #000000;"></i>
            </div>
        </div>
    </div>

    <div class="main">
        <div class="main-inner">

            <div class="main-inner-back">
                <?php
                    $back = $BackToFood[0];
                    echo '<a href="client_food.php?category_id=' . $back['category_id'] . '"><i class="fa-solid fa-arrow-left" style="color: #0d0d0d;"></i></a>';
                ?>
            </div>

            <div class="main-inner-info">
                <?php foreach ($foodInfo as $food): ?>

                    <div class="main-inner-info-img">
                        <p class="main-inner-info-img-text"><?php echo htmlspecialchars($food['food_name']); ?></p>
                        <img src="<?php echo htmlspecialchars($food['food_image']); ?>" alt="">
                    </div>

                    <div class="main-inner-info-dec">
                        <h2>Apraksts:</h2>
                        <p><?php echo htmlspecialchars($food['description']); ?></p>
                    </div>

                    <div class="main-inner-info-button">
                        <button id="addToCartBtn">Pievienot pasūtījumam</button>
                    </div>

                <?php endforeach; ?>
            </div>

        </div>
    </div>

    <div id="popup" class="popup"><i class="fa-regular fa-hexagon-check" style="color: #4CAF50;"></i></div>



    
</body>

<script src="scripts/client.js"></script>

</html>