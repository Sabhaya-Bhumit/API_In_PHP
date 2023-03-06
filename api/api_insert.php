<?php

include('config.php');
$confing = new Config();
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:POST');


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $book_name        = $_POST['book_name'];
    $author_name      = $_POST['author_name'];
    $price            = $_POST['price'];
    $publication_year = $_POST['publication_year'];
    $language         = $_POST['language'];
    $image            = $_FILES['image'];

    $img = uniqid() . "_" . $image['name'];

    $inserted_res = $confing->insert_recode($book_name, $author_name, $price, $publication_year, $language, $img);

    $filename = "../admin_panel/store/" . $img;
    $path     = $image['tmp_name'];
    if (move_uploaded_file($path, $filename)) {
        $res['data'] = "Inser image SuccessFuly...";

    } else {
        $res['data'] = "Inser image failed...";

    }

    if ($inserted_res) {
        $res['data'] = "Inser Recode SuccessFuly...";
    } else {
        $res['data'] = "Inser Recode failed...";
    }

} else {
    $res['data'] = "Fail Becose Is Not Use POST Method";
}
echo json_encode($res);

?>