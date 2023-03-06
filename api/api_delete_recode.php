<?php

include('config.php');
$config = new Config();


if ($_SERVER['REQUEST_METHOD'] == "DELETE") {
    parse_str(file_get_contents('php://input'), $_DELETE);

    $delete_res = $config->delete($_DELETE['id']);

    http_response_code(200);
    if ($delete_res) {
        $res['msg'] = "Recode Deleted Successfully...";
    } else {
        $res['msg'] = "Recode Deletion Faild...";
    }
} else {
    $res['msg'] = "Only Delete Request Is Allowed";
}

echo json_encode($res);
?>