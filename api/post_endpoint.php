<?php
include "db_config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postData = json_decode(file_get_contents('php://input'), true);

    if ($postData === null && json_last_error() !== JSON_ERROR_NONE) {
        http_response_code(400);
        echo "Nederigi JSON dati.";
        exit;
    }

    if (isset($postData['action'])) {
        $db = new dbconnect;
        $action = $postData['action'];

        if ($action === 'loginUser') {
            $data = [
                'username'  => $postData['username'],
                'password'  => $postData['password'],
            ];

            $result = $db->loginUser($data);

            if ($result !== null) {
                $response = array('success' => true, 'data' => $result);
            } else {
                $response = array('success' => false, 'message' => 'Nepareizs lietotājvārds vai parole');
            }

            header('Content-Type: application/json');
            echo json_encode($response);
        }

        if ($action === 'registerUser') {
            $data = [
                'username'  => $postData['username'],
                'password'  => $postData['password'],
            ];
        
            $result = $db->registerUser($data);

            if ($result !== null) {
                $response = array('success' => true, 'data' => $result);
                echo json_encode($response);
            } else {
                $response = array('success' => false, 'message' => 'Nepareizs lietotājvārds vai parole');
                echo json_encode($response);
            }
        }

        if ($action === 'postInfo') {
            $data = [
                'businessname'      => $postData['businessname'],
                'regnum'            => $postData['regnum'],
                'address'           => $postData['address'],
                'bank'              => $postData['bank'],
                'swift'             => $postData['swift'],
                'bankaccnum'        => $postData['bankaccnum'],
                'user_id'           => $postData['user_id'],
                'post_image'         => $postData['post_image'],
            ];
        
            $result = $db->postInfo($data);
        }

        if ($action === 'createMenu') {
            $data = [
                'menu_name'      => $postData['menu_name'],
                'public'         => $postData['menu_public'],
                'user_id'        => $postData['user_id'],
            ];
        
            $result = $db->createMenu($data);
        }

        if ($action === 'createCategory') {
            $data = [
                'category_name'           => $postData['category_name'],
                'category_public'         => $postData['category_public'],
                'category_position'       => $postData['category_position'],
                'cat_image'               => $postData['cat_image'],
                'menu_id'                 => $postData['menu_id'],
            ];
        
            $result = $db->createCategory($data);
        }

        if ($action === 'createFood') {
            $data = [
                'food_name'             => $postData['food_name'],
                'food_public'           => $postData['food_public'],
                'description'           => $postData['description'],
                'cooktime'              => $postData['cooktime'],
                'food_position'         => $postData['food_position'],
                'price'                 => $postData['price'],
                'activestart'           => $postData['activestart'],
                'activeend'             => $postData['activeend'],
                'food_image'            => $postData['food_image'],
                'cat_id'                => $postData['cat_id'],
            ];
            $result = $db->createFood($data);
        }


        
        if ($action === 'deleteMenu') {

            $menu_id = $postData['ID'];

            $result = $db->deleteMenu($menu_id);
        }

        if ($action === 'deleteCategory') {

            $cat_id = $postData['ID'];

            $result = $db->deleteCategory($cat_id);
        }

        if ($action === 'deleteFood') {

            $food_id = $postData['ID'];

            $result = $db->deleteFood($food_id);
        }



        
        if ($action === 'editInfo') {
            $data = [
                'businessname'      => $postData['businessname'],
                'regnum'            => $postData['regnum'],
                'address'           => $postData['address'],
                'bank'              => $postData['bank'],
                'swift'             => $postData['swift'],
                'bankaccnum'        => $postData['bankaccnum'],
                'user_id'           => $postData['user_id'],
            ];
        
            $result = $db->editInfo($data);
        }

        if ($action === 'editInfoImage') {
            $data = [
                'user_id'           => $postData['user_id'],
                'post_image'         => $postData['post_image'],
            ];
        
            $result = $db->editInfoImage($data);
        }

        if ($action === 'editMenu') {
            
            $data = [
                'Id'               => $postData['Id'],
                'edit_menu_name'   => $postData['edit_menu_name'],
                'edit_menu_public' => $postData['edit_menu_public'],
            ];
        
            $result = $db->editMenu($data);
        }

        if ($action === 'editCategory') {
            
            $data = [
                'Id'              => $postData['Id'],
                'edit_cat_name'   => $postData['edit_cat_name'],
                'edit_cat_pos'    => $postData['edit_cat_pos'],
                'edit_cat_public' => $postData['edit_cat_public'],
            ];
        
            $result = $db->editCategory($data);
        }

        if ($action === 'editCategoryImage') {
            
            $data = [
                'Id'              => $postData['Id'],
                'edit_cat_image'  => $postData['edit_cat_image'],
            ];
        
            $result = $db->editCategoryImage($data);
        }

        if ($action === 'editFood') {
            
            $data = [
                'Id'                 => $postData['Id'],
                'edit_food_name'     => $postData['edit_food_name'],
                'edit_food_public'   => $postData['edit_food_public'],
                'edit_description'   => $postData['edit_description'],
                'edit_cooktime'      => $postData['edit_cooktime'],
                'edit_food_position' => $postData['edit_food_position'],
                'edit_price'         => $postData['edit_price'],
                'edit_activestart'   => $postData['edit_activestart'],
                'edit_activeend'     => $postData['edit_activeend'],
                'edit_food_image'    => $postData['edit_food_image'],
            ];
        
            $result = $db->editFood($data);
        }
        
        


        
        
        
    }
}
?>
