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
    <link rel="stylesheet" href="style/category.css">
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
    <title>Category</title>
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

            <div class="create-category-container">

                <?php if (!empty($categories)) { ?>

                    <div class="food-info">
                        <div class="food-info-public">Publicēts</div>
                        <div class="food-info-name">Ēdienkartes nosaukums</div>
                        <div class="food-info-position">Pozīcija</div>
                    </div>

                <?php } else {

                    }
                ?>

                <div class="category-info"> 
                    <?php if (empty($categories)): ?>
                        <p>Nav izveidotas kategorijas</p>
                    <?php else: ?>
                        <?php foreach ($categories as $cat):?>  
                            <div class="category-item">
                                <div class="category-item-public">
                                    <label class="switch">
                                        <input type="checkbox" name="category_public" disabled <?php echo $cat['category_public'] ? 'checked' : ''; ?>>
                                        <span class="slider"></span>
                                    </label>
                                </div>
                                <div class="category-item-image">
                                    <?php if (!empty($cat['cat_image'])): ?>
                                        <div class="category-item-img-box"><img src="<?php echo htmlspecialchars($cat['cat_image']); ?>"></div>
                                    <?php else: ?>
                                        <p>Nav foto</p>
                                    <?php endif; ?>
                                </div>
                                <div class="category-item-name">
                                    <p><?php echo $cat['category_name']; ?></p>
                                </div>
                                <div class="category-item-position">
                                    <p><?php echo $cat['category_position']; ?></p>
                                </div>
                                <div class="category-item-edit-delete">
                                    <button type="button" class="edit-cat-popup-btn" onclick="openEditCatPopup(<?php echo $cat['id']; ?>)" 
                                        data-cat-name="<?php echo htmlspecialchars($cat['category_name']); ?>" 
                                        data-cat-public="<?php echo $cat['category_public']; ?>" 
                                        data-cat-position="<?php echo $cat['category_position']; ?>"
                                        >
                                        Labot
                                    </button>
                                    <p>/</p>
                                    <form method="POST">
                                        <input type="hidden" name="ID" value="<?php echo $cat['id']; ?>">
                                        <input type="hidden" name="action" value="deleteCategory">
                                        <button type="submit">Dzēst</button>
                                    </form>
                                </div>
                            </div>

                            <div id="category-edit-popup-<?php echo $cat['id']; ?>" class="category-edit-popup">
                                <form method="POST" enctype="multipart/form-data">
                                    <div class="category-edit-popup-content">
                                        <div class="category-edit-popup-content-head">
                                            <h1>Izmaini ēdienkarti</h1>
                                            <span class="category-edit-close" onclick="closeEditCatPopup(<?php echo $cat['id']; ?>)">&times;</span>
                                        </div>

                                        <div class="category-edit-popup-content-info">
                                            <div>
                                                <p>Kategorijas nosaukums</p>
                                                <input type="text" id="edit_cat_name" name="edit_cat_name" value="<?php echo htmlspecialchars($cat['category_name']); ?>">
                                            </div>

                                            <div>
                                                <p>Kategorijas pozīcija</p>
                                                <input type="text" id="edit_cat_pos" name="edit_cat_pos" value="<?php echo htmlspecialchars($cat['category_position']); ?>">
                                            </div>

                                            <div class="category-edit-popup-content-info-pub-img">
                                                <div class="category-edit-popup-content-info-img">
                                                    <p>Foto</p>
                                                    <input type="file" id="edit_cat_image-<?php echo $cat['id']; ?>" name="edit_cat_image" class="edit_cat_image" accept=".jpg, .jpeg, .png" value="">
                                                    <label for="edit_cat_image-<?php echo $cat['id']; ?>">
                                                        <i class="fa-regular fa-cloud-arrow-up" style="color: #5e5e5e;"></i>
                                                    </label>
                                                    <span id="edit-file-name-<?php echo $cat['id']; ?>">Izvēlies bildi</span>
                                                </div>
                                                
                                                <div>
                                                    <p>Publicēts</p>
                                                    <label class="switch">
                                                        <input type="checkbox" id="edit_cat_public" name="edit_cat_public" value="1" <?php echo $cat['category_public'] ? 'checked' : ''; ?>>
                                                        <span class="slider"></span>
                                                    </label>
                                                </div>  
                                            </div>

                                        </div>

                                        <div class="category-edit-popup-content-btn">
                                            <input type="hidden" name="action" value="editCategory">
                                            <input type="hidden" name="Id" value="<?php echo $cat['id']; ?>">
                                            <button type="submit" class="orangebtn" id="editCategory">Saglabāt</button>
                                            <a href="user_food.php?category_id=<?php echo $cat['id']; ?>">Rediģēt ēdienu</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <p type="button" class="category-add" id="showCategoryInfo">Pievienot kategoriju <i class="fa-solid fa-circle-plus fa-lg" style="color: #000000;"></i></p>
            
                <form method="POST" enctype="multipart/form-data">

                    <div class="category-info-insert hidden">
                        <h2>Pievienot jaunu kategoriju</h2>

                        <div class="category-info-insert-mid">
                            <div class="category-info-insert-mid-left">

                                <div>
                                    <p>Kategorijas nosaukums</p>
                                    <input type="text" id ="category_name" name="category_name" value="">
                                </div>

                                <div>
                                    <p>Pozīcija</p>
                                    <input type="text" id ="category_position" name="category_position" value="">
                                </div>
                                
                                <div>
                                    <p>Publicēts</p>
                                    <label class="switch">
                                        <input type="checkbox" id="category_public" name="category_public" value="0">
                                        <span class="slider"></span>
                                    </label>
                                </div>

                            </div>

                            <div class="category-info-insert-mid-right">
                                <p>Foto</p>
                                <input type="file" id="cat_image" name="cat_image" accept=".jpg, .jpeg, .png" value="">
                                <label for="cat_image">
                                    <i class="fa-regular fa-cloud-arrow-up" style="color: #5e5e5e;"></i>
                                </label>
                                <span id="file-name">Izvēlies bildi</span>
                            </div>
                        </div>

                        <div class="add-save-cat">
                            <input type="hidden" name="action" value="createCategory">
                            <button type="submit" class="orangebtn">Saglabāt</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div id="footerContainer"></div>
    
</body>
<script src="scripts/category.js"></script>
</html>
