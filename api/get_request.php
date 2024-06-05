<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class ApiGetRequest
{
    private $apiUrl;

    public function __construct($apiUrl)
    {
        $this->apiUrl = $apiUrl;
    }

    public function getRequest($action, $params = [])
    {
        $url = $this->apiUrl . '?action=' . urlencode($action);
        foreach ($params as $key => $value) {
            $url .= '&' . urlencode($key) . '=' . urlencode($value);
        }

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);

        $result = curl_exec($curl);
        if ($result === FALSE) {
            return "Curl error: " . curl_error($curl);
        }

        curl_close($curl);
        return $result;
    }
}

$apiUrl = "http://localhost/cms/api/get_endpoint.php";
$apiRequest = new ApiGetRequest($apiUrl);


$requestPathpost = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if ($requestPathpost === '/cms/user_page.php') {

    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        $response = $apiRequest->getRequest('getPost', ['user_id' => $user_id]);
        $posts = json_decode($response, true);

    }
}


$requestPathpost = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if ($requestPathpost === '/cms/user_menu.php') {

    if (isset($_SESSION['user_id'])) {

        $user_id = $_SESSION['user_id'];
        $response = $apiRequest->getRequest('getMenu', ['user_id' => $user_id]);
        $menus = json_decode($response, true);
    }
}


$requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if ($requestPath === '/cms/user_category.php') {

    if (isset($_GET['menu_id'])) {
        $menu_id = $_GET['menu_id'];

        $response = $apiRequest->getRequest('getCategory', ['menu_id' => $menu_id]);
        $categories = json_decode($response, true);

    }
    
}


$requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if ($requestPath === '/cms/user_food.php') {

    if (isset($_GET['category_id'])) {
        $cat_id = $_GET['category_id'];

        $response = $apiRequest->getRequest('getFood', ['category_id' => $cat_id]);
        $foods = json_decode($response, true);

    }

    if (isset($_GET['category_id'])) {
        $cat_id = $_GET['category_id'];

        $response = $apiRequest->getRequest('BackToCat', ['category_id' => $cat_id]);
        $BackToCat = json_decode($response, true);

    }
}


$requestPathpost = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if ($requestPathpost === '/cms/client_start.php') {

    if (isset($_GET['user_id'])) {
        $user_id = $_GET['user_id'];

        $response = $apiRequest->getRequest('getPost', ['user_id' => $user_id]);
        $posts = json_decode($response, true);

    }

    if (isset($_GET['user_id'])) {

        $user_id = $_GET['user_id'];
        $response = $apiRequest->getRequest('getMenu', ['user_id' => $user_id]);
        $menus = json_decode($response, true);
    }
}


$requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if ($requestPath === '/cms/client_cat.php') {

    if (isset($_GET['menu_id'])) {
        $menu_id = $_GET['menu_id'];

        $response = $apiRequest->getRequest('getCategory', ['menu_id' => $menu_id]);
        $categories = json_decode($response, true);

    }
    
}

$requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if ($requestPath === '/cms/client_food.php') {

    if (isset($_GET['category_id'])) {
        $cat_id = $_GET['category_id'];

        $response = $apiRequest->getRequest('getFood', ['category_id' => $cat_id]);
        $foods = json_decode($response, true);

    }

    if (isset($_GET['category_id'])) {
        $cat_id = $_GET['category_id'];

        $response = $apiRequest->getRequest('BackToCat', ['category_id' => $cat_id]);
        $BackToCat = json_decode($response, true);

    }
}

$requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if ($requestPath === '/cms/client_food_info.php') {

    if (isset($_GET['food_id'])) {
        $food_id = $_GET['food_id'];

        $response = $apiRequest->getRequest('getFoodInfo', ['food_id' => $food_id]);
        $foodInfo = json_decode($response, true);

    }

    if (isset($_GET['food_id'])) {
        $food_id = $_GET['food_id'];

        $response = $apiRequest->getRequest('BackToFood', ['food_id' => $food_id]);
        $BackToFood = json_decode($response, true);

    }
}

?>
