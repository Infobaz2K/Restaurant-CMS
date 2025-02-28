<?php

require_once 'utils.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class ApiPostRequest
{
    private $apiUrl;

    public function __construct($apiUrl)
    {
        $this->apiUrl = $apiUrl;
    }

    public function postRequest($postData)
    {
        $jsonData = json_encode($postData);

        if ($jsonData === false) {
            echo "JSON encoding error: " . json_last_error_msg();
            return false;
        }

        $headers = [
            'http' => [
                'method' => 'POST',
                'header' => 'Content-type: application/json',
                'content' => $jsonData,
            ]
        ];

        $context = stream_context_create($headers);
        $result = file_get_contents($this->apiUrl, false, $context);

        if ($result === false) {
            echo "Error making API request: " . error_get_last()['message'];
        }

        return $result;
    }

}

$apiUrl = "http://localhost/cms/api/post_endpoint.php";
$apiRequest = new ApiPostRequest($apiUrl);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        switch ($action) {

            case 'loginUser':

                $postData = [
                    'action'    => $action,
                    'username'  => htmlspecialchars($_POST['username']),
                    'password'  => htmlspecialchars($_POST['password']),
                ];
            
                $response = $apiRequest->postRequest($postData);
                $responseData = json_decode($response, true);
            
                if ($responseData !== false && isset($responseData['success']) && $responseData['success']) {

                    $userData = $responseData['data'];
                    $_SESSION['user_id'] = $userData["id"];
                    header("Location: user_page.php");

                } else {
                    $errorMessage = "Nepareizs lietotājvārds vai parole";
                }

                break;

            case 'registerUser':

                $postData = [
                    'action'    => $action,
                    'username'  => htmlspecialchars($_POST['username']),
                    'password'  => htmlspecialchars($_POST['password']),
                ];
    
                $response = $apiRequest->postRequest($postData);
                $responseData = json_decode($response, true);

                header("Location: login.php");

                break;
                
            case 'postInfo':

                $target_file = handleFileUpload("post_image", "uploads/");
    
                $postData = [
                    'action'                  => $action,
                    'businessname'            => htmlspecialchars($_POST['businessname']),
                    'regnum'                  => htmlspecialchars($_POST['regnum']),   
                    'address'                 => htmlspecialchars($_POST['address']),
                    'bank'                    => htmlspecialchars($_POST['bank']),
                    'swift'                   => htmlspecialchars($_POST['swift']),
                    'bankaccnum'              => htmlspecialchars($_POST['bankaccnum']),
                    'user_id'                 => $_SESSION['user_id'],
                    'post_image'              => $target_file,
                ];
                $response = $apiRequest->postRequest($postData);
                
                break;
            
    
            case 'createMenu':

                $menuPublic = isset($_POST['menu_public']) ? 1 : 0;
                
                $postData = [
                    'action'            => $action,
                    'menu_name'         => htmlspecialchars($_POST['menu_name']),
                    'menu_public'       => htmlspecialchars($menuPublic),   
                    'user_id'           => $_SESSION['user_id'],
                ];
                $response = $apiRequest->postRequest($postData);
            
                break;
    
            case 'createCategory':

                $categoryPublic = isset($_POST['category_public']) ? 1 : 0;
                $menu_id = $_GET['menu_id'];
                $target_file = handleFileUpload("cat_image", "uploads/");
                
                $postData = [
                    'action'                => $action,
                    'category_name'         => htmlspecialchars($_POST['category_name']),
                    'category_public'       => htmlspecialchars($categoryPublic),   
                    'category_position'     => htmlspecialchars($_POST['category_position']),
                    'cat_image'             => $target_file,
                    'menu_id'               => $menu_id,
                ];
                $response = $apiRequest->postRequest($postData);
            
                break;
    
            case 'createFood':
                
                $foodPublic = isset($_POST['food_public']) ? 1 : 0;
                $cat_id = $_GET['category_id'];
                $target_file = handleFileUpload("food_image", "uploads/");
                
                $postData = [
                    'action'                => $action,
                    'food_name'             => htmlspecialchars($_POST['food_name']),
                    'food_public'           => htmlspecialchars($foodPublic),
                    'description'           => htmlspecialchars($_POST['description']),
                    'cooktime'              => htmlspecialchars($_POST['cooktime']),
                    'food_position'         => htmlspecialchars($_POST['food_position']),
                    'price'                 => htmlspecialchars($_POST['price']),
                    'food_image'            => $target_file,
                    'cat_id'                => $cat_id,
                ];
                $response = $apiRequest->postRequest($postData);
            
                break;
    
            case 'deleteMenu':

                $menu_id = $_POST['ID'];
    
                $postData = [
                    'ID'        => $menu_id,
                    'action'    => $action,
                ];
                $response = $apiRequest->postRequest($postData);
            
                break;
    
            case 'deleteCategory':

                $cat_id = $_POST['ID'];
    
                $postData = [
                    'ID'        => $cat_id,
                    'action'    => $action,
                ];
                $response = $apiRequest->postRequest($postData);
            
                break;
    
            case 'deleteFood':

                $food_id = $_POST['ID'];
    
                $postData = [
                    'ID'        => $food_id,
                    'action'    => $action,
                ];
                $response = $apiRequest->postRequest($postData);
            
                break;
    
            case 'editInfo':
    
                $postData = [
                    'action'                  => $action,
                    'businessname'            => htmlspecialchars($_POST['businessname']),
                    'regnum'                  => htmlspecialchars($_POST['regnum']),   
                    'address'                 => htmlspecialchars($_POST['address']),
                    'bank'                    => htmlspecialchars($_POST['bank']),
                    'swift'                   => htmlspecialchars($_POST['swift']),
                    'bankaccnum'              => htmlspecialchars($_POST['bankaccnum']),
                    'user_id'                 => $_SESSION['user_id'],
                ];
                $response = $apiRequest->postRequest($postData);
            
                break;
    
            case 'editInfoImage':
    
                $target_file = handleFileUpload("post_image", "uploads/");
    
                $postData = [
                    'action'                  => $action,
                    'user_id'                 => $_SESSION['user_id'],
                    'post_image'              => $target_file,
                ];
                $response = $apiRequest->postRequest($postData);
            
                break;
    
            case 'editMenu':

                $menuPublic = isset($_POST['edit_menu_public']) ? 1 : 0;
                $menu_id = $_POST['Id'];
    
                $postData = [
                    'Id'                => $menu_id,
                    'action'            => $action,
                    'edit_menu_name'    => htmlspecialchars($_POST['edit_menu_name']),
                    'edit_menu_public'  => htmlspecialchars($menuPublic)
                ];
                $response = $apiRequest->postRequest($postData);
            
                break;
    
            case 'editCategory':

                $catPublic = isset($_POST['edit_cat_public']) ? 1 : 0;
                $cat_id = $_POST['Id'];
    
                $postData = [
                    'Id'                => $cat_id,
                    'action'            => $action,
                    'edit_cat_name'     => htmlspecialchars($_POST['edit_cat_name']),
                    'edit_cat_pos'      => htmlspecialchars($_POST['edit_cat_pos']),
                    'edit_cat_public'   => htmlspecialchars($catPublic),
                ];
                $response = $apiRequest->postRequest($postData);
            
                break;
    
            case 'editCategoryImage':

                $cat_id = $_POST['Id'];
                $target_file = handleFileUpload("edit_cat_image", "uploads/");
    
                $postData = [
                    'Id'                => $cat_id,
                    'action'            => $action,
                    'edit_cat_image'    => $target_file,
                ];
                $response = $apiRequest->postRequest($postData);
            
                break;
    
            case 'editFood':

                $foodPublic = isset($_POST['edit_food_public']) ? 1 : 0;
                $food_id = $_POST['Id'];
    
                $postData = [
                    'Id'                 => $food_id,
                    'action'             => $action,
                    'edit_food_name'     => htmlspecialchars($_POST['edit_food_name']),
                    'edit_description'   => htmlspecialchars($_POST['edit_description']),
                    'edit_cooktime'      => htmlspecialchars($_POST['edit_cooktime']),
                    'edit_food_position' => htmlspecialchars($_POST['edit_food_position']),
                    'edit_price'         => htmlspecialchars($_POST['edit_price']),
                    'edit_food_public'   => htmlspecialchars($foodPublic),
                ];
                $response = $apiRequest->postRequest($postData);
            
                break;
    
            case 'editFoodImage':

                $food_id = $_POST['Id'];
                $target_file = handleFileUpload("edit_food_image", "uploads/");
    
                $postData = [
                    'Id'                 => $food_id,
                    'action'             => $action,
                    'edit_food_image'    => $target_file,
                ];
                $response = $apiRequest->postRequest($postData);
            
                break;
            
            default:
            
                echo "Nav atrasts post request action";

                break;
        }  
    }
}
?>
