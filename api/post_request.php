<?php

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

        if ($action == 'loginUser') {
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

                echo "Pieslēgšanās neveiksmīga, mēģiniet vēlreiz.";
            }
            
        }

        if ($action == 'registerUser') {
            if (!isset($_POST["username"]) || !isset($_POST["password"])) {

            } else {
                $postData = [
                    'action'    => $action,
                    'username'  => htmlspecialchars($_POST['username']),
                    'password'  => htmlspecialchars($_POST['password']),
                ];
    
                $response = $apiRequest->postRequest($postData);
                $responseData = json_decode($response, true);

                header("Location: login.php");
            }
        }

        if ($action == 'postInfo') {

            $target_dir = "uploads/";
            $target_file = null;

            if ($_FILES["post_image"]["size"] > 0) {

                $file_extension = strtolower(pathinfo($_FILES["post_image"]["name"], PATHINFO_EXTENSION));

                if (in_array($file_extension, array("jpg", "jpeg", "png"))) {

                    $target_file = $target_dir . basename($_FILES["post_image"]["name"]);
                    move_uploaded_file($_FILES["post_image"]["tmp_name"], $target_file);

                }
            }

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
        
        }

        if ($action == 'createMenu') {
            $menuPublic = isset($_POST['menu_public']) ? 1 : 0;
            
            $postData = [
                'action'            => $action,
                'menu_name'         => htmlspecialchars($_POST['menu_name']),
                'menu_public'       => htmlspecialchars($menuPublic),   
                'user_id'           => $_SESSION['user_id'],
            ];
            $response = $apiRequest->postRequest($postData);
        }

        if ($action == 'createCategory') {
            $categoryPublic = isset($_POST['category_public']) ? 1 : 0;
            $menu_id = $_GET['menu_id'];

            $target_dir = "uploads/";
            $target_file = null;

            if ($_FILES["cat_image"]["size"] > 0) {

                $file_extension = strtolower(pathinfo($_FILES["cat_image"]["name"], PATHINFO_EXTENSION));

                if (in_array($file_extension, array("jpg", "jpeg", "png"))) {

                    $target_file = $target_dir . basename($_FILES["cat_image"]["name"]);
                    move_uploaded_file($_FILES["cat_image"]["tmp_name"], $target_file);

                }
            }
            
            $postData = [
                'action'                => $action,
                'category_name'         => htmlspecialchars($_POST['category_name']),
                'category_public'       => htmlspecialchars($categoryPublic),   
                'category_position'     => htmlspecialchars($_POST['category_position']),
                'cat_image'             => $target_file,
                'menu_id'               => $menu_id,
            ];
            $response = $apiRequest->postRequest($postData);
        }

        if ($action == 'createFood') {
            $foodPublic = isset($_POST['food_public']) ? 1 : 0;
            $cat_id = $_GET['category_id'];

            $target_dir = "uploads/";
            $target_file = null;

            if ($_FILES["food_image"]["size"] > 0) {

                $file_extension = strtolower(pathinfo($_FILES["food_image"]["name"], PATHINFO_EXTENSION));

                if (in_array($file_extension, array("jpg", "jpeg", "png"))) {

                    $target_file = $target_dir . basename($_FILES["food_image"]["name"]);
                    move_uploaded_file($_FILES["food_image"]["tmp_name"], $target_file);

                }
            }
            
            $postData = [
                'action'                => $action,
                'food_name'             => htmlspecialchars($_POST['food_name']),
                'food_public'           => htmlspecialchars($foodPublic),
                'description'           => htmlspecialchars($_POST['description']),
                'cooktime'              => htmlspecialchars($_POST['cooktime']),
                'food_position'         => htmlspecialchars($_POST['food_position']),
                'price'                 => htmlspecialchars($_POST['price']),
                'activestart'           => htmlspecialchars($_POST['activestart']),
                'activeend'             => htmlspecialchars($_POST['activeend']),
                'food_image'            => $target_file,
                'cat_id'                => $cat_id,
            ];
            $response = $apiRequest->postRequest($postData);
        }


        
        if ($action === 'deleteMenu') {
            $menu_id = $_POST['ID'];

            $postData = [
                'ID'        => $menu_id,
                'action'    => $action,
            ];
            $response = $apiRequest->postRequest($postData);
        }

        if ($action === 'deleteCategory') {
            $cat_id = $_POST['ID'];

            $postData = [
                'ID'        => $cat_id,
                'action'    => $action,
            ];
            $response = $apiRequest->postRequest($postData);
        }

        if ($action === 'deleteFood') {
            $food_id = $_POST['ID'];

            $postData = [
                'ID'        => $food_id,
                'action'    => $action,
            ];
            $response = $apiRequest->postRequest($postData);
        }




        if ($action == 'editInfo') {

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
        
        }

        if ($action == 'editInfoImage') {

            $target_dir = "uploads/";
            $target_file = null;

            if ($_FILES["post_image"]["size"] > 0) {

                $file_extension = strtolower(pathinfo($_FILES["post_image"]["name"], PATHINFO_EXTENSION));

                if (in_array($file_extension, array("jpg", "jpeg", "png"))) {

                    $target_file = $target_dir . basename($_FILES["post_image"]["name"]);
                    move_uploaded_file($_FILES["post_image"]["tmp_name"], $target_file);

                }
            }

            $postData = [
                'action'                  => $action,
                'user_id'                 => $_SESSION['user_id'],
                'post_image'              => $target_file,
            ];
            $response = $apiRequest->postRequest($postData);
        
        }

        if ($action === 'editMenu') {
            $menuPublic = isset($_POST['edit_menu_public']) ? 1 : 0;
            $menu_id = $_POST['Id'];

            $postData = [
                'Id'                => $menu_id,
                'action'            => $action,
                'edit_menu_name'    => htmlspecialchars($_POST['edit_menu_name']),
                'edit_menu_public'  => htmlspecialchars($menuPublic)
            ];
            $response = $apiRequest->postRequest($postData);
        }

        if ($action === 'editCategory') {
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
        }

        if ($action === 'editCategoryImage') {
            $cat_id = $_POST['Id'];

            $target_dir = "uploads/";
            $target_file = null;

            if ($_FILES["edit_cat_image"]["size"] > 0) {

                $file_extension = strtolower(pathinfo($_FILES["edit_cat_image"]["name"], PATHINFO_EXTENSION));

                if (in_array($file_extension, array("jpg", "jpeg", "png"))) {

                    $target_file = $target_dir . basename($_FILES["edit_cat_image"]["name"]);
                    move_uploaded_file($_FILES["edit_cat_image"]["tmp_name"], $target_file);

                }
            }

            $postData = [
                'Id'                => $cat_id,
                'action'            => $action,
                'edit_cat_image'    => $target_file,
            ];
            $response = $apiRequest->postRequest($postData);
        }

        if ($action === 'editFood') {
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
                'edit_activestart'   => htmlspecialchars($_POST['edit_activestart']),
                'edit_activeend'     => htmlspecialchars($_POST['edit_activeend']),
                'edit_food_public'   => htmlspecialchars($foodPublic),
            ];
            $response = $apiRequest->postRequest($postData);
        }

        if ($action === 'editFoodImage') {
            $food_id = $_POST['Id'];

            $target_dir = "uploads/";
            $target_file = null;

            if ($_FILES["edit_food_image"]["size"] > 0) {

                $file_extension = strtolower(pathinfo($_FILES["edit_food_image"]["name"], PATHINFO_EXTENSION));

                if (in_array($file_extension, array("jpg", "jpeg", "png"))) {

                    $target_file = $target_dir . basename($_FILES["edit_food_image"]["name"]);
                    move_uploaded_file($_FILES["edit_food_image"]["tmp_name"], $target_file);

                }
            }

            $postData = [
                'Id'                 => $food_id,
                'action'             => $action,
                'edit_food_image'    => $target_file,
            ];
            $response = $apiRequest->postRequest($postData);
        }
        
        
               
        

    }
}
?>
