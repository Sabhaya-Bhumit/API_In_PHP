<?php
include('config.php');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:POST');
$config = new Config();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $password = $_POST['password'];

    $res_bool = $config->login_user($username, $email, $password);

    if ($res_bool) {
        $res['msg'] = "SuccessFully";
    } else {
        if ($res_bool == "eamil") {
            $res['msg'] = "email";
        } else {

            $res['msg'] = "Faild";
        }
    }
} else {
    $res['msg'] = "Only POST METHOD Is ALLOWED...";
}

echo json_encode($res);

?>