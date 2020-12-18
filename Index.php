<?php
include("db/db.php");
header('Access-Control-Allow-Origin: *');


if($_SERVER['REQUEST_METHOD']=='GET'){
    if (isset($_GET['id'])){
        $query="select * from appointment where id=".$_GET['id'];
        $result=methodGet($query);
        echo json_encode($result->fetch(PDO::FETCH_ASSOC));
    }
    else{
        $query="select * from appointment";
        $result=methodGet($query);
        echo json_encode($result->fetchAll()); 
    }
    header("HTTP/1.1 200 OK");
    exit();
}
 
if($_POST['METHOD']=='POST'){
    unset($_POST['METHOD']);
    $name=$_POST['name'];
    $lastname=$_POST['lastname'];
    $document=$_POST['document'];
    $birthdate=$_POST['birthdate'];
    $address=$_POST['address'];
    $phone=$_POST['phone'];
    $query="insert into appointment(name, lastname, document, birthdate, address, phone) values ('$name', '$lastname', '$document', '$birthdate', '$address', '$phone')";
    $queryAutoIncrement="select MAX(id) as id from appointment";
    $result=methodPost($query, $queryAutoIncrement);
    echo json_encode($result);
    header("HTTP/1.1 200 OK");
    exit();
}
if($_POST['METHOD']=='PUT'){
    unset($_POST['METHOD']);
    $id=$_GET['id'];
    $name=$_POST['name'];
    $lastname=$_POST['lastname'];
    $document=$_POST['document'];
    $birthdate=$_POST['birthdate'];
    $address=$_POST['address'];
    $phone=$_POST['phone'];
    $query="UPDATE appointment SET name='$name', lastname='$lastname', document='$document', birthdate='$birthdate', address='$address', phone='$phone' WHERE id='$id'";
    $result=methodPut($query);
    echo json_encode($result);
    header("HTTP/1.1 200 OK");
    exit();
}

if($_POST['METHOD']=='DELETE'){
    unset($_POST['METHOD']);
    $id=$_GET['id'];
    $query="DELETE FROM appointment WHERE id='$id'";
    $result=methodDelete($query);
    echo json_encode($result);
    header("HTTP/1.1 200 OK");
    exit();
}

header("HTTP/1.1 400 Bad Request");
?>