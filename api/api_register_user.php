<?php
include('config.php');
$config = new Config();
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:POST');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email    = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $inserted_res = $config->register_user($username, $email, $password);
    // http_response_code(201);
    if ($inserted_res) {
        $res['msg'] = "User Registered SuccessFully...";
    } else {
        $res['msg'] = "User Registered Faild...";
    }
} else {
    $res['msg'] = "Only POST Mehotd Is Allowed";
}
echo json_encode($res);
?>