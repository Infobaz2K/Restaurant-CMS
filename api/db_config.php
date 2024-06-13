<?php

class dbconnect
{

    private $dbhost = "localhost";
    private $dbuser = "root";
    private $dbpass = "";
    private $dbname = "cms";
    private $mysqli;

    public function __construct() {

        $this->mysqli = new mysqli($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);

        if ($this->mysqli->connect_error) {
            die('Connect Error (' . $this->mysqli->connect_errno . ') ' . $this->mysqli->connect_error);
        }
    }



    public function getMysqli() {

        return $this->mysqli;
    }



    public function loginUser($data) {

        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("s", $data['username']);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();

        if ($user && password_verify($data['password'], $user['password'])) {
            unset($user['password']);
            return $user;
        } else {
            return null;
        }
    }



    public function registerUser($data) {

        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("ss", $data['username'], $hashedPassword);

        $stmt->execute();
        $stmt->close();
        
        return true;
    }


    
    public function getUser() {

        $sql = "SELECT id, username, password
                FROM user";

        $stmt = $this->mysqli->prepare($sql);
        $success = $stmt->execute();

        $result = $stmt->get_result();
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        $stmt->close();

        return $data;
    }



    public function postInfo($data) {

        $sql = "INSERT INTO posts (businessname, regnum, address, bank, swift, bankaccnum, user_id, post_image)
        VALUES (?,?,?,?,?,?,?,?)";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("ssssssis", $data['businessname'],
                                      $data['regnum'], 
                                      $data['address'], 
                                      $data['bank'],
                                      $data['swift'], 
                                      $data['bankaccnum'], 
                                      $data['user_id'],
                                      $data['post_image'],);
    
        $stmt->execute();
        $stmt->close();
    
        return true;
    }



    public function editInfo($data) {

        $sql = "UPDATE posts SET businessname = ?, regnum = ?, address = ?, bank = ?, swift = ?, bankaccnum = ? WHERE user_id = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("ssssssi", $data['businessname'],
                                     $data['regnum'], 
                                     $data['address'], 
                                     $data['bank'],
                                     $data['swift'], 
                                     $data['bankaccnum'],
                                     $data['user_id'],);

        $stmt->execute();
        $stmt->close();
    
        return true;
    }



    public function editInfoImage($data) {

        $sql = "UPDATE posts SET post_image = ? WHERE user_id = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("si", $data['post_image'],
                                $data['user_id'],);

        $stmt->execute();
        $stmt->close();
    
        return true;
    }



    public function getInfo($user_id) {

        $sql = "SELECT * FROM posts 
                JOIN users on posts.user_id = users.id
                WHERE user_id = ?";

        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();

        $result = $stmt->get_result();
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        $stmt->close();

        return $data;
    }



    public function createMenu($data) {

        $sql = "INSERT INTO menu (menu_name, public, user_id)
                VALUES (?,?,?)";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("sis", $data['menu_name'], $data['public'], $data['user_id']);
        $stmt->execute();
        $stmt->close();

        return true;
    }
    


    public function getMenu($user_id) {

        $sql = "SELECT * FROM menu WHERE user_id = ?";
    
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
    
        $result = $stmt->get_result();
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    
        $stmt->close();
    
        return $data;
    }



    public function deleteMenu($menu_id) {

        $categoryFoodsSql = "DELETE FROM category_foods WHERE category_id IN 
                             (SELECT category_id FROM menu_categories WHERE menu_id = ?)";
        $categoryFoodsStmt = $this->mysqli->prepare($categoryFoodsSql);
        $categoryFoodsStmt->bind_param("i", $menu_id);
        $categoryFoodsStmt->execute();
        $categoryFoodsStmt->close();
    
        $menuCategoriesSql = "DELETE FROM menu_categories WHERE menu_id = ?";
        $menuCategoriesStmt = $this->mysqli->prepare($menuCategoriesSql);
        $menuCategoriesStmt->bind_param("i", $menu_id);
        $menuCategoriesStmt->execute();
        $menuCategoriesStmt->close();
    
        $menuSql = "DELETE FROM menu WHERE id = ?";
        $menuStmt = $this->mysqli->prepare($menuSql);
        $menuStmt->bind_param("i", $menu_id);
        $menuStmt->execute();
        $menuStmt->close();
    
        $foodsSql = "DELETE FROM foods WHERE id NOT IN (SELECT food_id FROM category_foods)";
        $foodsStmt = $this->mysqli->prepare($foodsSql);
        $foodsStmt->execute();
        $foodsStmt->close();
    
        $categoriesSql = "DELETE FROM categories WHERE id NOT IN (SELECT category_id FROM menu_categories)";
        $categoriesStmt = $this->mysqli->prepare($categoriesSql);
        $categoriesStmt->execute();
        $categoriesStmt->close();
    
        return true;
    }
    


    public function editMenu($data) {
        
        $sql = "UPDATE menu SET menu_name = ?, public = ? WHERE id = ?";
        $stmt = $this->mysqli->prepare($sql);
    
        $stmt->bind_param("sii", $data['edit_menu_name'], $data['edit_menu_public'], $data['Id']);
        $stmt->execute();
        $stmt->close();
    
        return true;
    }



    public function createCategory($data) {  

        $sqlInsertCategory = "INSERT INTO categories (category_name, category_public, category_position, cat_image)
                              VALUES (?, ?, ?, ?)";
        $stmtInsertCategory = $this->mysqli->prepare($sqlInsertCategory);
        $stmtInsertCategory->bind_param("siis", $data['category_name'],
                                                $data['category_public'], 
                                                $data['category_position'], 
                                                $data['cat_image']);
        $stmtInsertCategory->execute();
        $categoryId = $stmtInsertCategory->insert_id;
        $stmtInsertCategory->close();
    
        $menu_id = $data['menu_id'];
        $sqlLinkMenuCategory = "INSERT INTO menu_categories (menu_id, category_id) VALUES (?, ?)";
        $stmtLinkMenuCategory = $this->mysqli->prepare($sqlLinkMenuCategory);
        $stmtLinkMenuCategory->bind_param("ii", $menu_id, $categoryId);
        $stmtLinkMenuCategory->execute();
        $stmtLinkMenuCategory->close();
    
        return true;
    }
    


    public function getCategory($menu_id) {
        $sql = "SELECT * FROM categories
                JOIN menu_categories ON categories.id = menu_categories.category_id
                WHERE menu_categories.menu_id = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $menu_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        $stmt->close();
        return $data;
    }



    public function editCategory($data) {
        
        $sql = "UPDATE categories SET category_name = ?, category_public = ?, category_position = ? WHERE id = ?";

        $stmt = $this->mysqli->prepare($sql);
    
        $stmt->bind_param("siii", $data['edit_cat_name'], $data['edit_cat_public'], $data['edit_cat_pos'], $data['Id']);
        $stmt->execute();
        $stmt->close();
    
        return true;
    }



    public function editCategoryImage($data) {
        
        $sql = "UPDATE categories SET cat_image = ? WHERE id = ?";

        $stmt = $this->mysqli->prepare($sql);
    
        $stmt->bind_param("si", $data['edit_cat_image'] , $data['Id']);
        $stmt->execute();
        $stmt->close();
    
        return true;
    }
    


    public function deleteCategory($cat_id) {
        
        $categoryFoodsSql = "DELETE FROM category_foods WHERE category_id = ?";
        $categoryFoodsStmt = $this->mysqli->prepare($categoryFoodsSql);
        $categoryFoodsStmt->bind_param("i", $cat_id);
        $categoryFoodsStmt->execute();
        $categoryFoodsStmt->close();
        
        $menuCategoriesSql = "DELETE FROM menu_categories WHERE category_id = ?";
        $menuCategoriesStmt = $this->mysqli->prepare($menuCategoriesSql);
        $menuCategoriesStmt->bind_param("i", $cat_id);
        $menuCategoriesStmt->execute();
        $menuCategoriesStmt->close();
        
        $categorySql = "DELETE FROM categories WHERE id = ?";
        $categoryStmt = $this->mysqli->prepare($categorySql);
        $categoryStmt->bind_param("i", $cat_id);
        $categoryStmt->execute();
        $categoryStmt->close();

        $foodsSql = "DELETE FROM foods WHERE id NOT IN (SELECT food_id FROM category_foods)";
        $foodsStmt = $this->mysqli->prepare($foodsSql);
        $foodsStmt->execute();
        $foodsStmt->close();

        return true;
    }



    public function getFood($cat_id) {
        $sql = "SELECT foods.*, category_foods.category_id, categories.category_name FROM foods
                JOIN category_foods ON foods.id = category_foods.food_id
                JOIN categories ON category_foods.category_id = categories.id
                WHERE category_foods.category_id = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $cat_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        $stmt->close();
        return $data;
    }



    public function getFoodInfo($food_id) {
        $sql = "SELECT * FROM foods
                WHERE id = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $food_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        $stmt->close();
        return $data;
    }



    public function createFood($data) {    

        $foodsql = "INSERT INTO foods (food_name, 
                                       food_public, 
                                       description, 
                                       cooktime, 
                                       food_position, 
                                       price, 
                                       food_image)
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
        $foodStmt = $this->mysqli->prepare($foodsql);
        $foodStmt->bind_param("sissids", 
                                        $data['food_name'], 
                                        $data['food_public'], 
                                        $data['description'], 
                                        $data['cooktime'], 
                                        $data['food_position'], 
                                        $data['price'], 
                                        $data['food_image']
                            );
        $foodStmt->execute();
        $food_id = $foodStmt->insert_id;
        $foodStmt->close();

    
        $cat_id = $data['cat_id'];
        $sqlLinkFoodCategory = "INSERT INTO category_foods (category_id, food_id) VALUES (?, ?)";
        $stmtFoodCategory = $this->mysqli->prepare($sqlLinkFoodCategory);
        $stmtFoodCategory->bind_param("ii", $cat_id, $food_id);
        $stmtFoodCategory->execute();
        $stmtFoodCategory->close();
    
        return true;
    }



    public function deleteFood($food_id) {
        
        $categoryFoodsSql = "DELETE FROM category_foods WHERE food_id = ?";
        $categoryFoodsStmt = $this->mysqli->prepare($categoryFoodsSql);
        $categoryFoodsStmt->bind_param("i", $food_id);
        $categoryFoodsStmt->execute();
        $categoryFoodsStmt->close();
    
        $foodsSql = "DELETE FROM foods WHERE id = ?";
        $foodsStmt = $this->mysqli->prepare($foodsSql);
        $foodsStmt->bind_param("i", $food_id);
        $foodsStmt->execute();
        $foodsStmt->close();
        
        return true;
    }



    public function editFood($data) {
        
        $sql = "UPDATE foods SET 
                    food_name = ?,
                    food_public = ?,
                    description = ?,
                    cooktime = ?,
                    food_position = ?,
                    price = ?
                WHERE id = ?";

        $stmt = $this->mysqli->prepare($sql);
    
        $stmt->bind_param("sissidi",
                                  $data['edit_food_name'], 
                                  $data['edit_food_public'], 
                                  $data['edit_description'],
                                  $data['edit_cooktime'],
                                  $data['edit_food_position'],
                                  $data['edit_price'],
                                  $data['Id']
                        );
        $stmt->execute();
        $stmt->close();
    
        return true;
    }



    public function editFoodImage($data) {
        
        $sql = "UPDATE foods SET 
                    food_image = ? 
                WHERE id = ?";

        $stmt = $this->mysqli->prepare($sql);
    
        $stmt->bind_param("si",
                                $data['edit_food_image'], 
                                $data['Id']
                        );
        $stmt->execute();
        $stmt->close();
    
        return true;
    }


    
    public function BackToCat($cat_id) {
        $sql = "SELECT DISTINCT menu.id AS menu_id, categories.id AS category_id
                FROM categories
                LEFT JOIN category_foods ON category_foods.category_id = categories.id
                LEFT JOIN foods ON foods.id = category_foods.food_id
                LEFT JOIN menu_categories ON categories.id = menu_categories.category_id
                LEFT JOIN menu ON menu_categories.menu_id = menu.id
                WHERE categories.id = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $cat_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        $stmt->close();
        return $data;
    }



    public function BackToFood($food_id) {
        $sql = "SELECT DISTINCT foods.id AS food_id, categories.id AS category_id
                FROM foods
                LEFT JOIN category_foods ON category_foods.food_id = foods.id
                LEFT JOIN categories ON categories.id = category_foods.category_id
                LEFT JOIN menu_categories ON categories.id = menu_categories.category_id
                LEFT JOIN menu ON menu_categories.menu_id = menu.id
                WHERE foods.id = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $food_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        $stmt->close();
        return $data;
    }
    
}
?>
