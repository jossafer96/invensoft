<?php
$action = $_POST["mode"];

if ($action==1) {
    $id = $_POST["id"];
    $product = ProductData::getById($id);
    echo json_encode($product);
};

if($action==2){
    $id = $_POST["id"];
    $operations = OperationData::getAllByProductId($id);
    echo json_encode($operations);
};

if($action==3){
    $id = $_POST["id"];
    $user = UserData::getById($id);
    echo json_encode($user);
};

if($action==4){
    $id = $_POST["id"];
    $password = PasswordData::getByProductId($id);
    echo json_encode($password);
};

if($action==5){
    $id = $_POST["id"];
    $asings = AsingsData::getAllById($id);
    echo json_encode($asings);
};

if($action==6){
    $id = $_POST["id"];
    $user = PersonData::getById($id);
    echo json_encode($user);
};


?>