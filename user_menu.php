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
    <link rel="stylesheet" href="style/user_menu.css">
    <title>Menu</title>
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

            <div class="create-food-menu-container">

                <?php if (!empty($menus)) { ?>

                    <div class="food-info">
                        <div class="food-info-public">Publicēts</div>
                        <div class="food-info-name">Ēdienkartes nosaukums</div>
                    </div>

                <?php } else {

                    }
                ?>

                <div class="menu-info">
                    <?php if (empty($menus)): ?>
                        <p>Nav izveidotas ēdienkartes</p>
                    <?php else: ?> 
                        <?php foreach ($menus as $menu): ?>
                                <?php
                                // echo '<pre>';
                                // print_r($menu);
                                // echo '</pre>';
                                ?>
                                <div class="menu-item">
                                    <div class="menu-item-public">
                                        <label class="switch">
                                            <input type="checkbox" name="public" disabled <?php echo htmlspecialchars($menu['public']) ? 'checked' : ''; ?>>
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                    <div class="menu-item-name">
                                        <p><?php echo htmlspecialchars($menu['menu_name']); ?></p>
                                    </div>
                                    <div class="menu-item-edit-delete">
                                        <button type="button" class="edit-menu-popup-btn" onclick="openEditMenuPopup(<?php echo $menu['id']; ?>)" 
                                            data-menu-name="<?php echo htmlspecialchars($menu['menu_name']); ?>" 
                                            data-menu-public="<?php echo htmlspecialchars($menu['public']); ?>"
                                            >
                                            Labot
                                        </button>
                                        <p>/</p>
                                        <form method="POST">
                                            <input type="hidden" name="ID" value="<?php echo $menu['id']; ?>">
                                            <input type="hidden" name="action" value="deleteMenu">
                                            <button type="submit">Dzēst</button>
                                        </form>
                                    </div>
                                </div>

                                <div id="menu-edit-popup-<?php echo $menu['id']; ?>" class="menu-edit-popup">
                                    <form method="POST">
                                        <div class="menu-edit-popup-content">
                                            <?php //echo $menu['id']; ?>
                                            <div class="menu-edit-popup-content-head">
                                                <h1>Izmaini ēdienkarti</h1>
                                                <span class="menu-edit-close" onclick="closeEditMenuPopup(<?php echo $menu['id']; ?>)">&times;</span>
                                            </div>

                                            <div class="menu-edit-popup-content-info">
                                                <div>
                                                    <p>Nomaini ēdienkartes nosaukumu</p>
                                                    <input type="text" id="edit_menu_name" name="edit_menu_name" value="<?php echo htmlspecialchars($menu['menu_name']); ?>">
                                                </div>

                                                <div>
                                                    <p>Publicēts</p>
                                                    <label class="switch">
                                                        <input type="checkbox" id="edit_menu_public" name="edit_menu_public" value="1" <?php echo htmlspecialchars($menu['public']) ? 'checked' : ''; ?>>
                                                        <span class="slider"></span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="menu-edit-popup-content-btn">
                                                <input type="hidden" name="action" value="editMenu">
                                                <input type="hidden" name="Id" value="<?php echo $menu['id']; ?>">
                                                <button type="submit" class="orangebtn" id="editMenu">Saglabāt</button>
                                                <a href="user_category.php?menu_id=<?php echo $menu['id']; ?>">Rediģēt kategoriju</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                        <?php endforeach;?>
                    <?php endif; ?>
                </div>

                <p type="button" class="add-menu" id="showMenuInfo">Pievienot ēdienkarti <i class="fa-solid fa-circle-plus fa-lg" style="color: #000000;"></i></p>
                
                <form method="POST">

                    <div class="menu-info-insert hidden">
                        <h2>Pievienot jaunu ēdienkarti</h2>

                        <div>
                            <p>Ēdienkartes nosaukums</p>
                            <input type="text" id ="menu_name" name="menu_name" value="">
                        </div>
                        
                        <div>
                            <p>Publicēts</p>
                            <label class="switch">
                                <input type="checkbox" id="menu_public" name="menu_public" value="0">
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="add-save-menu">
                            <input type="hidden" name="action" value="createMenu">
                            <button type="submit" class="orangebtn">Saglabāt</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>

        
    </div>

    <div id="footerContainer"></div>
</body>
<script src="scripts/menu.js"></script>
</html>