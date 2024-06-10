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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style/food.css">
    <link rel="stylesheet" data-purpose="Layout StyleSheet" title="Web Awesome" href="/css/app-wa-462d1fe84b879d730fe2180b0e0354e0.css?vsn=d">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/all.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-thin.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-solid.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-regular.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-light.css">
    <title>Food</title>
</head>
<body>

    <div id="headerContainer"></div>

    <div class="main">

        <div class="main-buttons">
            <div class="main-buttons-inner">
                <a href="user_page.php">Uzņēmuma informācija</a>
                <div class="button-line"></div>
                <a href="user_menu.php" class="active">Ēdienkartes</a>
            </div>
        </div>

        <div class="main-inner">

            <div class="create-food-container">

                <div class="food-table-head">
                    
                    <?php
                        $back = $BackToCat[0];
                        echo '<a href="user_category.php?menu_id=' . $back['menu_id'] . '"><i class="fa-regular fa-arrow-left fa-sm" style="color: #000000;"></i> Atpakaļ uz kategoriju</a>';
                    ?>

                    <h3>
                        <?php 
                            if (!empty($foods)) {
                                $food = $foods[0];
                                echo htmlspecialchars($food['category_name']);
                            } else {
                                echo "<p>Nav izveidoti ēdieni</p>";
                            }
                        ?>
                    </h3>
                </div>

                <div class="food-table-container">
                    <?php foreach ($foods as $food):?>
                        <div class="food-table">

                            <div class="food-table-item">

                                <div class="food-table-item-img">
                                    <?php if (!empty($food['food_image'])): ?>
                                        <div class="food-table-item-img-box"><img src="<?php echo htmlspecialchars($food['food_image']); ?>"></div>
                                    <?php else: ?>
                                        <p>Nav foto</p>
                                    <?php endif; ?>
                                </div>

                                <div class="food-table-item-info">
                                    <table>
                                        <tr class="trhead">
                                            <th>Nosaukums</th>
                                            <th>Apraksts </th>
                                            <th>Pagatavošana</th>
                                            <th>Publicēts</th>
                                            <th>Pozīcija</th>
                                            <th>Cena</th>
                                            <th></th>
                                        </tr>
                                        <tr class="trtext">
                                            <td><?php echo htmlspecialchars($food['food_name']); ?></td>
                                            <td><div class="scrollable-text"><?php echo htmlspecialchars($food['description']); ?></div></td>
                                            <td><?php echo htmlspecialchars($food['cooktime']); ?></td>
                                            <td>
                                                <label class="switch">
                                                    <input type="checkbox" name="food_public" disabled <?php echo htmlspecialchars($food['food_public']) ? 'checked' : ''; ?>>
                                                    <span class="slider"></span>
                                                </label>
                                            </td>
                                            <td><?php echo htmlspecialchars($food['food_position']); ?></td>
                                            <td><p><?php echo htmlspecialchars($food['price']); ?></p></td>
                                            <td>
                                                <div class="food-item-edit-delete">
                                                    <button type="button" class="edit-food-popup-btn" onclick="openEditFoodPopup(<?php echo $food['id']; ?>)" 
                                                        data-food-name="<?php echo htmlspecialchars($food['food_name']); ?>" 
                                                        data-food-public="<?php echo $food['food_public']; ?>" 
                                                        data-food-desc="<?php echo $food['description']; ?>"
                                                        data-food-cook="<?php echo $food['cooktime']; ?>" 
                                                        data-food-position="<?php echo $food['food_position']; ?>"
                                                        data-food-price="<?php echo $food['price']; ?>"
                                                        >
                                                        Labot
                                                    </button>
                                                    <p>/</p>
                                                    <form method="POST">
                                                        <input type="hidden" name="ID" value="<?php echo $food['id']; ?>">
                                                        <input type="hidden" name="action" value="deleteFood">
                                                        <button type="submit">Dzēst</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div id="food-edit-popup-<?php echo $food['id']; ?>" class="food-edit-popup">
                                <div class="food-edit-popup-content">
                                    <div class="food-edit-popup-content-head">
                                        <h1>Izmaini ēdienu</h1>
                                        <span class="food-edit-close" onclick="closeEditFoodPopup(<?php echo $food['id']; ?>)">&times;</span>
                                    </div>

                                    <div class="food-edit-popup-content-info">
                                        <form id="foodForm-<?php echo $food['id']; ?>" method="POST">
                                            <div>
                                                <p>Produkta nosaukums</p>
                                                <input type="text" id="edit_food_name-<?php echo $food['id']; ?>" name="edit_food_name" value="<?php echo htmlspecialchars($food['food_name']); ?>">
                                            </div>

                                            <div>
                                                <p>Ēdiena apraksts</p>
                                                <input type="text" id="edit_description-<?php echo $food['id']; ?>" name="edit_description" value="<?php echo htmlspecialchars($food['description']); ?>">
                                            </div>

                                            <div>
                                                <p>Pagatavošanas laiks</p>
                                                <input type="text" id="edit_cooktime-<?php echo $food['id']; ?>" name="edit_cooktime" value="<?php echo htmlspecialchars($food['cooktime']); ?>">
                                            </div>

                                            <div>
                                                <p>Pozīcija</p>
                                                <input type="text" id="edit_food_position-<?php echo $food['id']; ?>" name="edit_food_position" value="<?php echo htmlspecialchars($food['food_position']); ?>">
                                            </div>

                                            <div>
                                                <p>Cena</p>
                                                <input type="text" class="edit_price" name="edit_price" value="<?php echo htmlspecialchars($food['price']); ?>">
                                            </div>
                                        
                                            <div class="food-popup-public">
                                                <p>Publicēts</p>
                                                <label class="switch">
                                                    <input type="checkbox" id="edit_food_public-<?php echo $food['id']; ?>" name="edit_food_public" 
                                                        value="1" <?php echo $food['food_public'] ? 'checked' : ''; ?>>
                                                    <span class="slider"></span>
                                                </label>
                                            </div>
                                            
                                            <input type="hidden" name="action" value="editFood">
                                            <input type="hidden" name="Id" value="<?php echo $food['id']; ?>">
                                        </form>

                                        <div class="food-edit-popup-content-info-photo-active">
                                            <form id="autoFoodImage-<?php echo $food['id']; ?>" method="POST" enctype="multipart/form-data">
                                                <div>
                                                    <p>Foto</p>
                                                    <input type="file" id="edit_food_image-<?php echo $food['id']; ?>" name="edit_food_image" class="edit_food_image" accept=".jpg, .jpeg, .png" value="">
                                                    <label for="edit_food_image-<?php echo $food['id']; ?>">
                                                        <i class="fa-regular fa-cloud-arrow-up" style="color: #5e5e5e;"></i>
                                                    </label>
                                                    <span id="edit-file-name-<?php echo $food['id']; ?>">Izvēlies bildi</span>
                                                </div>
                                                <input type="hidden" name="action" value="editFoodImage">
                                                <input type="hidden" name="Id" value="<?php echo $food['id']; ?>">
                                            </form>
                                        </div>
                                    </div>

                                    <div class="add-save-food-popup">
                                        <button type="button" class="orangebtn" id="editFoodButton-<?php echo $food['id']; ?>">Saglabāt</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;?>
                </div>

                <p type="button" class="food-add" id="showFoodInfo">Pievienot jaunu produktu <i class="fa-solid fa-circle-plus fa-lg" style="color: #000000;"></i></p>
            
                <form method="POST" enctype="multipart/form-data">

                    <div class="food-info-insert hidden">
                        <h2>Pievienot jaunu produktu</h2>

                        <div class="food-info-insert-mid">
                            <div class="food-info-insert-mid-left">
                                <div>
                                    <p>Produkta nosaukums</p>
                                    <input type="text" id ="food_name" name="food_name" value="">
                                </div>

                                <div>
                                    <p>Ēdiena apraksts</p>
                                    <input type="text" id ="description" name="description" value="">
                                </div>

                                <div>
                                    <p>Pagatavošanas laiks</p>
                                    <input type="text" id ="cooktime" name="cooktime" value="">
                                </div>
                            </div>

                            <div class="food-info-insert-mid-right">
                                <div>
                                    <p>Pozīcija</p>
                                    <input type="text" id ="food_position" name="food_position" value="">
                                </div>

                                <div>
                                    <p>Cena</p>
                                    <input type="text" id ="price" name="price" value="">
                                </div>

                                <div class="food-info-insert-mid-photo-active">
                                    <div>
                                        <p>Foto</p>
                                        <input type="file" id="food_image" name="food_image" accept=".jpg, .jpeg, .png" value="">
                                        <label for="food_image">
                                            <i class="fa-regular fa-cloud-arrow-up" style="color: #5e5e5e;"></i>
                                        </label>
                                        <span id="file-name">Izvēlies bildi</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="add-save-food">
                            <div>
                                <p>Publicēts</p>
                                <label class="switch">
                                    <input type="checkbox" id="food_public" name="food_public" value="0">
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <input type="hidden" name="action" value="createFood">
                            <button type="submit" class="orangebtn">Saglabāt</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div id="footerContainer"></div>
    
</body>
<script src="scripts/food.js"></script>
</html>