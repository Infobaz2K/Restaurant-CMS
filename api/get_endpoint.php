<?php
include "db_config.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $getData = json_decode(file_get_contents('php://input'), true);
    
    header('Content-Type: application/json');
    
    $db = new dbconnect;
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        $jsonResponse = null;

        switch ($action) {
            
            case 'getPost':

                $user_id = $_GET['user_id'];
                $result = $db->getPost($user_id);  
                $jsonResponse = json_encode($result);
            
                break;
    
            case 'getMenu':

                $user_id = $_GET['user_id'];
                $result = $db->getMenu($user_id);  
                $jsonResponse = json_encode($result);
            
                break;
    
            case 'getCategory':

                $menu_id = $_GET['menu_id'];
                $result = $db->getCategory($menu_id);
                $jsonResponse = json_encode($result);
            
                break;
    
            case 'getFood':

                $cat_id = $_GET['category_id'];
                $result = $db->getFood($cat_id);
                $jsonResponse = json_encode($result);
            
                break;
    
            case 'getFoodInfo':

                $food_id = $_GET['food_id'];
                $result = $db->getFoodInfo($food_id);
                $jsonResponse = json_encode($result);
            
                break;
    
            case 'BackToCat':

                $cat_id = $_GET['category_id'];
                $result = $db->BackToCat($cat_id);
                $jsonResponse = json_encode($result);
            
                break;
    
            case 'BackToFood':

                $food_id = $_GET['food_id'];
                $result = $db->BackToFood($food_id);
                $jsonResponse = json_encode($result);
            
                break;
            
            default:

                echo "Nav atrasts get enpoint action";

                break;
        }  

        if ($jsonResponse !== null) {
            echo $jsonResponse;
        } else {
            http_response_code(400);
            echo json_encode(array('error' => 'Invalid action'));
        }
    } else {
        http_response_code(400);
        echo json_encode(array('error' => 'Action parameter missing '));
    }
} else {
    http_response_code(405);
    echo "Only GET requests are allowed.";
}

?>