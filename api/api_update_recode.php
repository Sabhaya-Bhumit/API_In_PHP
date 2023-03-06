<?php
include('config.php');

header('Content-Type: applicaion/json');
header('Access-control-Allow-Method: PUT,PATCH');

$config = new Config();


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // parse_str(file_get_contents("php://input"), $_PUT_PATCH);
    $id               = $_POST['id'];
    $book_name        = $_POST['book_name'];
    $author_name      = $_POST['author_name'];
    $price            = $_POST['price'];
    $publication_year = $_POST['publication_year'];
    $language         = $_POST['language'];
    $image            = $_FILES['image'];

    $img = uniqid() . "_" . $image['name'];


    $filename = "../admin_panel/store/" . $img;
    $path     = $image['tmp_name'];


    $update_res = $config->update($id, $book_name, $author_name, $price, $publication_year, $language, $img);


    if (move_uploaded_file($path, $filename)) {
        $res['data'] = "Recode image update SuccessFuly...";

    } else {
        $res['data'] = "Inser image update failed...";

    }


    if ($update_res) {
        $res['msg'] = "Recode Update Successfully....";
    } else {
        $res['msg'] = "Recode UPdation Failed...";
    }
} else {
    $res['msg'] = "Only POST Requests Are Allowed.........";
}

echo json_encode($res);

?>