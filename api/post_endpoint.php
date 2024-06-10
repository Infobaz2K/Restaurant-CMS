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

        switch ($action) {

            case 'loginUser':

                if (!isset($postData['username']) || empty($postData['username']) || !isset($postData['password']) || empty($postData['password'])) {
                    
                } else {
                    $data = [
                        'username' => htmlspecialchars($postData['username']),
                        'password' => htmlspecialchars($postData['password']),
                    ];
            
                    $result = $db->loginUser($data);
            
                    if ($result !== null) {
                        $response = array('success' => true, 'data' => $result);
                    } else {
                        $response = array('success' => false);
                    }
                }
            
                header('Content-Type: application/json');
                echo json_encode($response);
            
                break;            
            
            case 'registerUser':
            
                if (!isset($postData['username']) || empty($postData['username']) || !isset($postData['password']) || empty($postData['password'])) {

                } else {

                    $data = [
                        'username' => htmlspecialchars($postData['username']),
                        'password' => htmlspecialchars($postData['password']),
                    ];
            
                    $result = $db->registerUser($data);
                }
            
                break;
            
            case 'postInfo':
            
                if (
                    !isset($postData['businessname']) || empty($postData['businessname']) ||
                    !isset($postData['regnum']) || empty($postData['regnum']) ||
                    !isset($postData['address']) || empty($postData['address']) ||
                    !isset($postData['bank']) || empty($postData['bank']) ||
                    !isset($postData['swift']) || empty($postData['swift']) ||
                    !isset($postData['bankaccnum']) || empty($postData['bankaccnum']) ||
                    !isset($postData['user_id']) || empty($postData['user_id']) ||
                    !isset($postData['post_image']) || empty($postData['post_image'])
                ) {

                } else {
                    $data = [
                        'businessname' => htmlspecialchars($postData['businessname']),
                        'regnum' => htmlspecialchars($postData['regnum']),
                        'address' => htmlspecialchars($postData['address']),
                        'bank' => htmlspecialchars($postData['bank']),
                        'swift' => htmlspecialchars($postData['swift']),
                        'bankaccnum' => htmlspecialchars($postData['bankaccnum']),
                        'user_id' => htmlspecialchars($postData['user_id']),
                        'post_image' => htmlspecialchars($postData['post_image']),
                    ];
            
                    $result = $db->postInfo($data);
            
                }
            
                break;
            
            case 'createMenu':

                if (
                    !isset($postData['menu_name']) || empty($postData['menu_name']) ||
                    (!isset($postData['menu_public']) && empty($postData['menu_public'])) ||
                    !isset($postData['user_id']) || empty($postData['user_id'])
                ) {
                    
                } else {
                    $data = [
                        'menu_name'      => htmlspecialchars($postData['menu_name']),
                        'public'         => htmlspecialchars($postData['menu_public']),
                        'user_id'        => htmlspecialchars($postData['user_id']),
                    ];
                
                    $result = $db->createMenu($data);
                
                }
                
                break;
                
            case 'createCategory':

                if (
                    !isset($postData['category_name']) || empty($postData['category_name']) ||
                    (!isset($postData['category_public']) && empty($postData['category_public'])) ||
                    !isset($postData['category_position']) || empty($postData['category_position']) ||
                    !isset($postData['cat_image']) || empty($postData['cat_image']) ||
                    !isset($postData['menu_id']) || empty($postData['menu_id'])
                ) {

                } else {

                    $data = [
                        'category_name'       => htmlspecialchars($postData['category_name']),
                        'category_public'     => htmlspecialchars($postData['category_public']),
                        'category_position'   => htmlspecialchars($postData['category_position']),
                        'cat_image'           => htmlspecialchars($postData['cat_image']),
                        'menu_id'             => htmlspecialchars($postData['menu_id']),
                    ];
            
                    $result = $db->createCategory($data);
                }
                break;     
    
            case 'createFood':
                
                if (
                    !isset($postData['food_name']) || empty($postData['food_name']) ||
                    (!isset($postData['food_public']) && empty($postData['food_public'])) ||
                    !isset($postData['description']) || empty($postData['description']) ||
                    !isset($postData['cooktime']) || empty($postData['cooktime']) ||
                    !isset($postData['food_position']) || empty($postData['food_position']) ||
                    !isset($postData['price']) || empty($postData['price']) ||
                    !isset($postData['activestart']) || empty($postData['activestart']) ||
                    !isset($postData['activeend']) || empty($postData['activeend']) ||
                    !isset($postData['food_image']) || empty($postData['food_image']) ||
                    !isset($postData['cat_id']) || empty($postData['cat_id'])
                ) {

                } else {

                    $data = [
                        'food_name'       => htmlspecialchars($postData['food_name']),
                        'food_public'     => htmlspecialchars($postData['food_public']),
                        'description'     => htmlspecialchars($postData['description']),
                        'cooktime'        => htmlspecialchars($postData['cooktime']),
                        'food_position'   => htmlspecialchars($postData['food_position']),
                        'price'           => htmlspecialchars($postData['price']),
                        'activestart'     => htmlspecialchars($postData['activestart']),
                        'activeend'       => htmlspecialchars($postData['activeend']),
                        'food_image'      => htmlspecialchars($postData['food_image']),
                        'cat_id'          => htmlspecialchars($postData['cat_id']),
                    ];

                    $result = $db->createFood($data);
                }

                break;
    
            case 'deleteMenu':

                if (!isset($postData['ID']) || empty($postData['ID'])) {

                } else {
                    $menu_id = $postData['ID'];
                    $result = $db->deleteMenu($menu_id);
                }
                
                break;
            
            case 'deleteCategory':

                if (!isset($postData['ID']) || empty($postData['ID'])) {

                } else {
                    $cat_id = $postData['ID'];
                    $result = $db->deleteCategory($cat_id);
                }

                break;
            
            case 'deleteFood':
                
                if (!isset($postData['ID']) || empty($postData['ID'])) {

                } else {
                    $food_id = $postData['ID'];
                    $result = $db->deleteFood($food_id);
                }

                break;
                
            case 'editInfo':

                if (
                    !isset($postData['businessname']) || empty($postData['businessname']) ||
                    !isset($postData['regnum']) || empty($postData['regnum']) ||
                    !isset($postData['address']) || empty($postData['address']) ||
                    !isset($postData['bank']) || empty($postData['bank']) ||
                    !isset($postData['swift']) || empty($postData['swift']) ||
                    !isset($postData['bankaccnum']) || empty($postData['bankaccnum']) ||
                    !isset($postData['user_id']) || empty($postData['user_id'])
                ) {

                } else {

                    $data = [
                        'businessname'      => htmlspecialchars($postData['businessname']),
                        'regnum'            => htmlspecialchars($postData['regnum']),
                        'address'           => htmlspecialchars($postData['address']),
                        'bank'              => htmlspecialchars($postData['bank']),
                        'swift'             => htmlspecialchars($postData['swift']),
                        'bankaccnum'        => htmlspecialchars($postData['bankaccnum']),
                        'user_id'           => $postData['user_id'],
                    ];
                    
                    $result = $db->editInfo($data);
                }

                break;
                
            case 'editInfoImage':

                if (
                    !isset($postData['user_id']) || empty($postData['user_id']) ||
                    !isset($postData['post_image']) || empty($postData['post_image'])
                ) {

                } else {
                    
                    $data = [
                        'user_id'       => $postData['user_id'],
                        'post_image'    => $postData['post_image'],
                    ];
                    
                    $result = $db->editInfoImage($data);
                }

                break; 
    
            case 'editMenu':

                if (
                    !isset($postData['Id']) || empty($postData['Id']) ||
                    !isset($postData['edit_menu_name']) || empty($postData['edit_menu_name']) ||
                    (!isset($postData['edit_menu_public']) && empty($postData['edit_menu_public']))
                ) {

                } else {
                    
                    $data = [
                        'Id'               => $postData['Id'],
                        'edit_menu_name'   => $postData['edit_menu_name'],
                        'edit_menu_public' => $postData['edit_menu_public'],
                    ];
                    
                    $result = $db->editMenu($data);
                }

                break;
    
            case 'editCategory':
                
                if (
                    !isset($postData['Id']) || empty($postData['Id']) ||
                    !isset($postData['edit_cat_name']) || empty($postData['edit_cat_name']) ||
                    !isset($postData['edit_cat_pos']) || empty($postData['edit_cat_pos']) ||
                    (!isset($postData['edit_cat_public']) && empty($postData['edit_cat_public']))
                ) {

                } else {

                    $data = [
                        'Id'              => $postData['Id'],
                        'edit_cat_name'   => $postData['edit_cat_name'],
                        'edit_cat_pos'    => $postData['edit_cat_pos'],
                        'edit_cat_public' => $postData['edit_cat_public'],
                    ];
                    
                    $result = $db->editCategory($data);
                }

                break;
    
            case 'editCategoryImage':
                
                if (
                    !isset($postData['Id']) || empty($postData['Id']) ||
                    !isset($postData['edit_cat_image']) || empty($postData['edit_cat_image'])
                ) {

                } else {

                    $data = [
                        'Id'              => $postData['Id'],
                        'edit_cat_image'  => $postData['edit_cat_image'],
                    ];
                    
                    $result = $db->editCategoryImage($data);
                }

                break;
    
            case 'editFood':
                
                if (
                    !isset($postData['Id']) || empty($postData['Id']) ||
                    !isset($postData['edit_food_name']) || empty($postData['edit_food_name']) ||
                    (!isset($postData['edit_food_public']) && empty($postData['edit_food_public'])) ||
                    !isset($postData['edit_description']) || empty($postData['edit_description']) ||
                    !isset($postData['edit_cooktime']) || empty($postData['edit_cooktime']) ||
                    !isset($postData['edit_food_position']) || empty($postData['edit_food_position']) ||
                    !isset($postData['edit_price']) || empty($postData['edit_price']) ||
                    !isset($postData['edit_activestart']) || empty($postData['edit_activestart']) ||
                    !isset($postData['edit_activeend']) || empty($postData['edit_activeend'])
                ) {

                } else {

                    $data = [
                        'Id'                 => htmlspecialchars($postData['Id']),
                        'edit_food_name'     => htmlspecialchars($postData['edit_food_name']),
                        'edit_food_public'   => htmlspecialchars($postData['edit_food_public']),
                        'edit_description'   => htmlspecialchars($postData['edit_description']),
                        'edit_cooktime'      => htmlspecialchars($postData['edit_cooktime']),
                        'edit_food_position' => htmlspecialchars($postData['edit_food_position']),
                        'edit_price'         => htmlspecialchars($postData['edit_price']),
                        'edit_activestart'   => htmlspecialchars($postData['edit_activestart']),
                        'edit_activeend'     => htmlspecialchars($postData['edit_activeend']),
                    ];
            
                    $result = $db->editFood($data);
                }

                break;
    
            case 'editFoodImage':
                
                if (
                    !isset($postData['Id']) || empty($postData['Id']) ||
                    !isset($postData['edit_food_image']) || empty($postData['edit_food_image'])
                ) {

                } else {

                    $data = [
                        'Id'                 => htmlspecialchars($postData['Id']),
                        'edit_food_image'    => htmlspecialchars($postData['edit_food_image']),
                    ];
            
                    $result = $db->editFoodImage($data);
                }

                break;

            default:
                
                echo "Nav atrasts post endpoint action";

                break;
        }
    }
}
?>
